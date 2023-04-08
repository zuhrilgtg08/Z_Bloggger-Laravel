<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RatingComments;
use Illuminate\Http\Request;

class PopularPostsController extends Controller
{
    public function index()
    {
        $all_post = Post::with('rating_comments')->latest()->get();

        $rate = $all_post->map(function ($query) {
            $postRate = RatingComments::where('post_id', '=', $query->id)->get();
            if ($postRate->count() == 0) {
                $query->like_value = 0;
            } else {
                $ratings = $postRate->sum('like_value') / $postRate->count();
                $query->like_value = $ratings;
            }

            return $query;
        });

        $datas = $rate->filter(function ($row) {
            return $row->like_value >= 4;
        });

        return view('pages.users.popular', [
            'datas' => $datas
        ]);
    }
}
