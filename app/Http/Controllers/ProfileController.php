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
        $user = User::findOrFail($id); // プロファイル情報を含むユーザーを取得
        return view('profile.show')->with('user', $user); // ユーザー情報をビューに渡す
    }

    public function edit() {
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        return view('profile.edit')->with('user', $user); // 編集用のビューを返す
    }

    public function update(Request $request, $id)
    {
        // バリデーションルールを定義
        $request->validate([
            'age' => 'required|integer',
            'gender' => 'required|string',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048', // 画像バリデーション
        ]);

        // ユーザーを取得
        $user = User::findOrFail($id);

        // プロフィール情報の更新
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->bio = $request->input('bio');

        // プロファイル画像の処理
        if ($request->hasFile('profile_image')) {
            // 既存の画像があれば削除
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            // 新しい画像を保存し、パスをデータベースに保存
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('profile.show', $user->id)->with('message', 'Profile updated successfully.');
    }
}
