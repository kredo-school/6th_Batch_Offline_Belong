<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function rules()
    {
        return view('rules'); // ルールページのビューを表示
    }
}
