<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment'); // ペイメントページのビューを表示
    }
}
