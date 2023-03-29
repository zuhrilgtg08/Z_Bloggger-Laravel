<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopularPostsController extends Controller
{
    public function index()
    {
        return view('pages.users.popular');
    }
}
