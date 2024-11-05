<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\Storage; // Storageファサードを追加

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Profile::where('user_id', Auth::id())->first(); // 現在のユーザーのプロファイル情報を取得
        $user = User::find(Auth::id()); // 現在のユーザー情報を取得
        return view('profile.show', compact('profile', 'user')); // プロファイルとユーザー情報をビューに渡す
    }

    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first(); // プロフィール情報を取得
        $user = User::find(Auth::id()); // 現在のユーザー情報を取得
        return view('profile.edit', compact('profile', 'user')); // 編集用のビューを返す
    }

    public function update(Request $request)
    {
        $request->validate([
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像バリデーションの追加
        ]);

        $data = $request->only('age', 'gender', 'bio');

        // 画像の処理
        if ($request->hasFile('profile_image')) {
            // 古い画像を削除
            $profile = Profile::where('user_id', Auth::id())->first();
            if ($profile && $profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $imagePath;
        }

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->route('profile.show')->with('message', 'Profile updated successfully!');
    }
}
