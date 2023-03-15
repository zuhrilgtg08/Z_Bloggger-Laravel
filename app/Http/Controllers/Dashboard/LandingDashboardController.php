<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RatingComments;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LandingDashboardController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', '!=', true)->get();
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('pages.admin.index', [
            'posts' => $posts,
            'users' => $users
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
