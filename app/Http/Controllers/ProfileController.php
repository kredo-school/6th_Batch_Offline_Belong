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
    ]);

    // ユーザーを取得し、データを更新
    $user = User::findOrFail($id);
    $user->profile()->update([
        'age' => $request->age,
        'gender' => $request->gender,
        'bio' => $request->bio,
    ]);

    return redirect()->route('profile.show', $user->id)->with('message', 'Profile updated successfully.');
}
}
