<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\RatingComments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardRatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Post::with('rating_comments')->where('user_id', Auth::user()->id)
                        ->latest()->get();

        $row = $ratings->map(function ($query) {
            $rating = RatingComments::where('post_id', '=', $query->id)->get();
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

        return view('pages.admin.ratings.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.admin.ratings.show',[
            'post' => Post::where('id', $id)->first(),
            'rating' => RatingComments::where('post_id', $id)
                    ->get(['like_value', 'comment', 'user_id'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RatingComments::where('post_id', $id)->delete();
        return redirect()->route('dashboard.ratings.index')->with('delete', 'The rating this post has been Deleted!');
    }
}
