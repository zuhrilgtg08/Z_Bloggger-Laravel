<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Bookmarks;
use Illuminate\Http\Request;
use App\Models\RatingComments;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LandingDashboardController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', '!=', true)->get();
        $bookmarks = Bookmarks::where('b_user_id', Auth::user()->id)->get();
        $trashed = Post::where([
                    ['user_id', Auth::user()->id],
                    ['deleted_at', '!=', null]
                ])->withTrashed()->get();
        $ratings = Post::with('rating_comments')->where('user_id', Auth::user()->id)->latest()->get();
        $row = $ratings->map(function ($query) {
            $rating = RatingComments::where([
                ['post_id', '=', $query->id],
            ])->get();
            if ($rating->count() == 0) {
                $query->like_value = 0;
            } else {
                $first = $rating->sum('like_value') / $rating->count();
                $query->like_value = $first;
            }

            return $query;
        });

        $data = $row->filter(function ($value) {
            return $value->like_value >= 1;
        });

        $posts = Post::where('user_id', Auth::user()->id)->get();
        
        $result1 = [
            Bookmarks::all()->count(),
            RatingComments::all()->count(),
            Post::all()->count(),
        ];

        $result2 = [
            User::where('is_admin', false)->get()->count(),
            Category::all()->count(),
            Post::withTrashed()->where('deleted_at', '!=', null)->get()->count()
        ];
        
        return view('pages.admin.index', [
            'posts' => $posts,
            'users' => $users,
            'bookmarks' => $bookmarks,
            'trashed' => $trashed,
            'ratings' => $data,
            'result1' => $result1,
            'result2' => $result2,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.setting_account.overview', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'max:150|string',
            'username' => 'max:155|string',
            'email' => 'email:dns|string',
            'image' => 'image|file|max:2048|mimes:jpg,png,jpeg',
            'no_hp' => 'numeric|min:13',
            'about_person' => 'string|min:155',
            'work_person' => 'string|max:100',
        ]);

        if ($request->file('image')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validateData['image'] = $request->file('image')->store('uploaded-Profile');
        }

        User::where('id', Auth::user()->id)->update($validateData);

        return back()->with('success', 'Profile berhasil di ubah');
    }

    public function updatePassword(Request $request, $id)
    {
        $data_pass = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8'
        ]);

        if ($data_pass) {
            if (Hash::check($request->current_password, $data_pass->password)) {
                if ($request->new_password == $request->confirm_password) {
                    User::where('id', Auth::user()->id)->update([
                        'password' => Hash::make($request->new_password)
                    ]);

                    return back()->with('success', 'Password Has Been Changes!');
                }
            }
            return back()->with('fail', 'Someting Wrong Password Type!');
        }
    }
}
