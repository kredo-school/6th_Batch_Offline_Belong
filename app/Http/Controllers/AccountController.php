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
        $user = User::findOrFail($id); // プロファイル情報を含むユーザーを取得
        return view('account.show')->with('user', $user); // ユーザー情報をビューに渡す
    }

    public function edit() {
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        return view('account.edit')->with('user', $user); // 編集用のビューを返す
    }

    public function update(Request $request, $id)
{
    
}
}
