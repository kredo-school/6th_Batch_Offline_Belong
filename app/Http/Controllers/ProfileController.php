<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Profile::where('user_id', Auth::id())->first(); // 現在のユーザーのプロファイル情報を取得
        return view('profile.show', compact('profile'));
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:10',
        ]);

        $profile = Profile::updateOrCreate(
            ['user_id' => Auth::id()], // ユーザーIDで検索
            $request->only('age', 'gender') // プロファイル情報を更新
        );

        return redirect()->route('profile.show')->with('message', 'Profile updated successfully!');
    }
}
