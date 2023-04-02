<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RatingComments;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $tag = '';

        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $tag = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $tag = ' By ' . $author->name;
        }

        return view('pages.users.landing_home.home', [
            'tag' => $tag,
            "data" => Post::with(['Category', 'author'])->latest()->filter(request(['keyword', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $keyword = $request->get('keyword');

            if ($keyword != '') {
                $data = Post::where('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('Category', function ($query) use ($keyword) {
                        return $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('author', function ($query) use ($keyword) {
                        return $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('email', 'like', '%' . $keyword . '%');
                    })->get();
            } else {
                $data = Post::with(['Category', 'author'])
                        ->orderBy('id', 'DESC')->take(6)->latest()->get();
            }

            $totalRow = $data->count();

            if ($totalRow > 0) {
                foreach ($data as $item) {
                    $username_author = $item->author->username;
                    $name_author = $item->author->name;
                    $name_category = $item->category->name;
                    $slug_category = $item->category->slug;
                    $created_at = $item->created_at->diffForHumans();

                    if($item->image == null) {
                        $gambar = 'images/404.png';
                    } else {
                        $gambar = '/storage/' . $item->image;
                    }

                    $output .= "
                        <div class='col-md-4 mb-4'>
                            <div class='card h-100 shadow'>
                                <img src=$gambar alt='default-post' class='img-fluid card-img-top' />
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $item->title . "</h5>
                                    <p>By.
                                        <small class='text-muted'>
                                            <a href='/?author=$username_author'
                                                class='text-decoration-none'>$name_author</a> in
                                            <a href='/?category=$slug_category'
                                                class='text-decoration-none'>$name_category</a>
                                                $created_at
                                        </small>
                                    </p>
                                    <p class='card-text'>$item->excerpt</p>
                                    <a href='/home/post/detail/$item->id' class='btn btn-primary'>Detail</a>
                                </div>
                            </div>
                        </div>
                    ";
                }
            } else {
                $output = '
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <img src="images/404.png" alt="default-post" class="img-fluid card-img-top" />
                                <div class="card-body">
                                    <h5 class="card-title text-center">Data Post Not Found!</h5>
                                </div>
                            </div>
                        </div>
                    ';
            }

            $data = array(
                'output' => $output,
                'total' => $totalRow
            );

            return json_encode($data);
        }
    }

    public function detail($id)
    {
        $data = Post::where('id', $id)->first();

        if(Auth::guest()) {
            $reviews = RatingComments::where('post_id', $id)->get();
        } else {
            $reviews = RatingComments::where('post_id', $id)
                    ->where('user_id', Auth::user()->id)->get();
        }

        return view('pages.users.landing_home.detail', [
            'data' => $data,
            'reviews' => $reviews
        ]);
    }

    public function ratingComment(Request $request)
    {
        $reviews = RatingComments::where('user_id', Auth::user()->id)
            ->where('post_id', $request->post_id)->first();

        if ($reviews !== null) {
            $reviews->update([
                'comment' => $request->comment,
                'like_value' => $request->rating
            ]);

            return redirect()->back()->with('success', 'Rating berhasil diupdate!');
            
        } else {
            $reviews = RatingComments::create([
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
                'comment' => $request->comment,
                'like_value' => $request->rating
            ]);

            return redirect()->back()->with('success', 'Rating berhasil ditambahkan!');
        }
    }

    public function addBookmark(Request $request)
    {
        dd($request->all());
    }
}
