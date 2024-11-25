<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    private $user;



    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id)
    {
        // 現在のユーザーがアドミンであるか確認
        if (Auth::user()->role === 'admin') {
            // アドミンはアカウントページにアクセスできない
            return redirect()->route('home')->with('error', 'Admins cannot access this page.');
        }

        // アドミンでない場合はリクエストされたユーザーの情報を取得
        $user = User::findOrFail($id); // リクエストされたIDのユーザー情報を取得
        $cred = $user->payments; // ユーザーの支払い情報を取得

        // アカウントページを表示
        return view('account.show', compact('user', 'cred'));
    }


    public function edit() {
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        return view('account.edit')->with('user', $user); // 編集用のビューを返す
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;


        $user->save();

        return redirect()->route('account.show', $user->id)->with('message', 'Information updated successfully.');
    }

    public function withdrawal()
    {
        return view('account.withdrawal');
    }

    public function destroy($id)
{
    // ユーザーを取得
    $user = User::findOrFail($id);

    // ユーザーの削除
    $user->delete();

    // メッセージ付きでリダイレクト
    return redirect()->route('account.show', ['id' => $user->id])->with('success', 'Your account has been deleted successfully.');
}


}
