<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->paginate(3); // ユーザーの投稿を4件ずつ取得

        return view('profile.show', compact('user', 'posts'));
    }

    public function edit() {
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        return view('profile.edit')->with('user', $user); // 編集用のビューを返す
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_image')) {
            $user->profile_image = 'data:image/'.$request->profile_image->extension().';base64,'.base64_encode(file_get_contents($request->profile_image));
        }
        $user->save();

        return redirect()->route('profile.show', $user->id)->with('message', 'Profile updated successfully.');
    }



}
