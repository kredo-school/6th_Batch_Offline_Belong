<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile; // Profileモデルをインポートする
use Illuminate\Support\Facades\Auth; // Authをインポートする

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // 現在のユーザー情報を取得
        return view('profile.show')->with("user", $user); // プロファイルとユーザー情報をビューに渡す
    }

    public function edit() {
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        return view('profile.edit')->with("user", $user); // 編集用のビューを返す
    }

    public function update(Request $request, $id)
    {
        // バリデーションルールを定義
        $request->validate([
            'age' => 'required|integer',
            'gender' => 'required|string',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:2048', // 画像バリデーション
        ]);
    
        // ユーザーを取得
        $user = User::findOrFail($id); // $userを定義する
    
        // ユーザー情報の更新
        $user->fill($request->except('profile_image'));
    
        // プロファイル画像の処理
        if ($request->hasFile('profile_image')) {
            $user->profile_image = 'data:profile_image/' . $request->profile_image->extension() .
                ';base64,' . base64_encode(file_get_contents($request->profile_image));
        }
    
        $user->save();
    
        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully.');
    }
    
}
