<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardTrashedPostsController extends Controller
{
    public function index()
    {
        $posts_trash = Post::where([
            ['user_id', Auth::user()->id],
            ['deleted_at', '!=', null]
        ])->withTrashed()->get();

        return view('pages.admin.trashed.index', compact('posts_trash'));
    }

    public function restore($id)
    {
        Post::withTrashed()->where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->restore();

        return redirect()->back()->with('success', 'Post Has Been Restored!');
    }

    public function restoreAll()
    {
        Post::onlyTrashed()->where('user_id', Auth::user()->id)->restore();

        return redirect()->back()->with('success', 'All Post Has Been Restored Again!');
    }

    public function destroy($id)
    {
        Post::withTrashed()->where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->forceDelete();

        return redirect()->back()->with('deleted', 'This Post Has Been Delete Permanent!');
    }

    public function destroyAll()
    {
        Post::onlyTrashed()->where('user_id', Auth::user()->id)->forceDelete();

        return redirect()->back()->with('deleted', 'All Post Has Been Deleted Permanent Only!');
    }
}
