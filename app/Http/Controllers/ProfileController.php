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

    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first(); // プロフィール情報を取得
        return view('profile.show', compact('profile')); // 編集用のビューを返す
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:500', // バリデーションの追加
        ]);

        // プロファイル情報を更新または作成
        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only('age', 'gender', 'bio')
        );

        // 編集ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
    }
}
