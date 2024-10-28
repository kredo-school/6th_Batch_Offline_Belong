<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        // Logic for FAQ page
        return view('faq'); // Adjust to your actual view file
    }

    public function about()
    {
        // Logic for About Us page
        return view('aboutus'); // Adjust to your actual view file
    }
}
