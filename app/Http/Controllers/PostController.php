<?php

namespace App\Http\Controllers;

use App\Models\Post; // PostモデルをインポートApp\Http\Controllers\Category
use App\Models\Category; // これを追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function create()
    {
        $post = new Post();
        $all_categories = Category::all(); // すべてのカテゴリーを取得
        return view('posts.create', compact('post', 'all_categories')); // $postも渡す
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'reservation_due_date' => 'required|date',
            'place' => 'required|string|max:255',
            'planned_number_of_people' => 'nullable|integer',
            'participation_fee' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|exists:categories,id', // カテゴリーのバリデーションを追加
        ]);

        // 投稿の保存
        $this->post->title = $request->title;
        $this->post->date = $request->date;
        $this->post->reservation_due_date = $request->reservation_due_date;
        $this->post->place = $request->place;
        $this->post->planned_number_of_people = $request->planned_number_of_people;
        $this->post->participation_fee = $request->participation_fee;
        $this->post->description = $request->description;
        $this->post->user_id = auth()->id();

        if ($request->image) {
            $this->post->image = 'data:image/' . $request->image->extension() .
                ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $this->post->save();

        // 投稿に選択されたカテゴリーを関連付ける
        $this->post->categories()->attach($request->category);

        // 保存後に詳細ページへリダイレクト
        return redirect()->route('posts.show', ['id' => $this->post->id]);
    }

    public function show($id)
    {
        $posts = Post::with('user')->latest()->get(); // 投稿とユーザー情報を取得
    
        // 指定されたIDの投稿を取得
        $post = Post::findOrFail($id); // 存在しない場合は404エラーを投げる

        // ビューに投稿を渡して表示
        return view('posts.show', compact('post')); // 'posts.show'は表示するビューの名前
    }

    public function index()
    {
         // 1ページに6件表示
         $posts = Post::latest()->paginate(6);
        return view('posts.schedule')->with('posts', $posts);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $all_categories = Category::all(); // すべてのカテゴリーを取得
        return view('posts.edit', compact('post', 'all_categories')); // カテゴリーをビューに渡す
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'reservation_due_date' => 'required|date',
            'place' => 'required|string|max:255',
            'planned_number_of_people' => 'nullable|integer',
            'participation_fee' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|exists:categories,id', // カテゴリーのバリデーションを追加
        ]);
    
        // 投稿の更新
        $post->title = $request->title;
        $post->date = $request->date;
        $post->reservation_due_date = $request->reservation_due_date;
        $post->place = $request->place;
        $post->planned_number_of_people = $request->planned_number_of_people;
        $post->participation_fee = $request->participation_fee;
        $post->description = $request->description;
    
        // 画像がアップロードされた場合は更新
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }
    
        $post->save();
    
        // カテゴリーを更新
        $post->categories()->sync([$request->category]);
    
        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully.');
    }
    

    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->forceDelete();

        // 削除後に投稿一覧ページにリダイレクト
        return redirect()->route('posts.show')->with('success', 'Post deleted successfully.');
    }



}


