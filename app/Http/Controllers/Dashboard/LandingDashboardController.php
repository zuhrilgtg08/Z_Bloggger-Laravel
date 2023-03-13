<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RatingComments;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LandingDashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('pages.admin.index', ['posts' => $posts]);
    }
}
