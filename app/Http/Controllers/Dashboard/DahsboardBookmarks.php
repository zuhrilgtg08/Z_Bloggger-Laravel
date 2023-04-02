<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Bookmarks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DahsboardBookmarks extends Controller
{
    public function index()
    {
        return view('pages.admin.bookmarks.index', [
            'data_books' => Bookmarks::where('b_user_id', Auth::user()->id)->get()
        ]);
    }

    public function destroy($id)
    {
        $first = Bookmarks::findOrFail($id);
        $first->delete();
        return redirect()->route('dashboard.bookmarks.index')->with('delete', 'Bookmarks this post has been Removed!');
    }
}
