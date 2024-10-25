<?php

namespace App\Http\Controllers;

use App\Models\Post; // Postモデルをインポート
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create'); // フォームを表示するビューを返す
    }

    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'reservation_due_date' => 'required|date',
            'place' => 'required|string|max:255',
            'planned_number_of_people' => 'nullable|integer',
            'participation_fee' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像のアップロード
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // publicストレージに保存
            $validatedData['image'] = $imagePath; // パスをデータに追加
        }

        // 新しい投稿を作成
        Post::create($validatedData);

        // リダイレクト
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
}
