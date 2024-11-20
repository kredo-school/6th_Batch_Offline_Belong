<?php

namespace App\Http\Controllers\Admin; // 管理者の名前空間

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; // モデルをインポート
use Auth;

class ReceptionController extends Controller
{
    // お問い合わせ内容一覧の表示
    public function index()
    {
        // 送信されたデータを取得
        $contacts = Contact::latest()->get();

        // ビューにデータを渡す
        return view('admin.reception')->with('contacts', $contacts);
    }

    // お問い合わせ内容の保存
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // データベースに保存
        Contact::create($validated);

        // レスポンスを返す
        return redirect()->back()->with('success', 'お問い合わせ内容を受け付けました！');
    }

    public function destroy($id)
    {
        // IDを使ってメッセージを取得し、削除
        $contact = Contact::findOrFail($id);
        $contact->delete();

        // 削除後、成功メッセージをセッションに設定してリダイレクト
        return redirect()->route('admin.receptions')->with('success', 'メッセージが削除されました。');
    }

}
