<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // モデルのインポート
use Illuminate\Support\Facades\Auth; // Authのインポート

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment'); // ペイメントページのビューを表示
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
}
