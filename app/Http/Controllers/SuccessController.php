<?php

// app/Http/Controllers/SuccessController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessController extends Controller
{
    public function index()
    {
        return view('success'); // 成功ページのビューを表示
    }
}