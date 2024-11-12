<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // モデルのインポート
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Authのインポート
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    private $user;
    public function show()
    {
        return view('payment'); // ペイメントページのビューを表示
    }

    public function edit($id) { 

      
        $user = User::findOrFail(Auth::id()); // 現在のユーザー情報を取得
        $payment_cred = $user->payments;
        return view('payment.edit')->with("user",$user)->with("payment_cred", $payment_cred); // ビューにユーザーと支払い情報を渡す
    }
    

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'card_number' => 'required|string',
            'expiry_month' => 'required|string',
            'expiry_year' => 'required|string',
            'cvv' => 'required|string',
            'name' => 'required|string',
        ]);

        // 支払い情報を保存
        Payment::create([
            'user_id' => Auth::id(), // 現在のユーザーIDを追加
            'card_number' => $request->card_number,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'cvv' => $request->cvv,
            'name' => $request->name,
        ]);

        // 成功メッセージやリダイレクト
        return redirect()->route('success.page')->with('message', 'Payment successful!');
    }

    public function update(Request $request, $id)
    {
        // 現在のユーザーを取得
        $user = User::findOrFail($id);

        // 支払い情報を取得（ユーザーに関連する最初の支払い情報を更新）
        $payment_cred = $user->payments->first();

        // バリデーション
        $request->validate([
            'card_number' => 'required|string',
            'expiry_month' => 'required|string',
            'expiry_year' => 'required|string',
            'cvv' => 'required|string',
            'name' => 'required|string',
        ]);

        // 支払い情報の更新
        $payment_cred->card_number = $request->card_number;
        $payment_cred->expiry_month = $request->expiry_month;
        $payment_cred->expiry_year = $request->expiry_year;
        $payment_cred->cvv = $request->cvv;
        $payment_cred->name = $request->name;

        // 支払い情報の保存
        $payment_cred->save();

        // 更新が完了したことを通知するリダイレクト
        return redirect()->route('account.show', $user->id)->with('message', 'Payment information updated successfully!');
    }

}
