<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
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
        $all_categories = Category::all();
        return view('posts.create', compact('post', 'all_categories'));
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
            'category' => 'required|exists:categories,id',
        ]);

        // 投稿の保存
        $this->post->fill($request->except('image', 'category'));
        $this->post->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $this->post->image = 'data:image/' . $request->image->extension() .
                ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $this->post->save();

        $categories = is_array($request->category) ? $request->category : [$request->category];
        $this->post->categories()->attach($categories);
    
        return redirect()->route('posts.show', ['id' => $this->post->id]);
    }

    public function show($id)
    {
        $post = Post::with(['user', 'categories'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function index()
    {
        // 投稿を取得（ページネーション付き）
        $all_posts = Post::latest()->paginate(6);

        // ビューに変数を渡す
        return view('posts.schedule')->with('all_posts', $all_posts);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id); // 投稿をIDで取得
        $all_categories = Category::all(); // 全てのカテゴリを取得

        // 投稿に関連付けられているカテゴリを取得（多対多の関係を仮定）
        $selected_categories = $post->categories->pluck('id')->toArray();

        // ビューにデータを渡す
        return view('posts.edit', compact('post', 'all_categories', 'selected_categories'));
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
            'category' => 'required|exists:categories,id',
        ]);

        // 投稿の更新
        $post->fill($request->except('image', 'category'));

        if ($request->hasFile('image')) {
            $post->image = 'data:image/' . $request->image->extension() .
                ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        // リクエストからカテゴリIDのリストを取得
        $categories = is_array($request->category) ? $request->category : [$request->category];
        $post->categories()->sync($categories);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully.');
    }
    

        public function category($category)
    {
        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->latest()->paginate(6);

        return view("posts.$category", compact('posts'));
    }

    // app/Http/Controllers/PostController.php

    public function play()
    {
        // 'play' カテゴリのIDを取得
        $category = Category::where('name', 'play')->first();

        if (!$category) {
            // カテゴリが存在しない場合の処理
            return redirect()->route('posts.schedule')->with('error', 'Play category not found.');
        }

        // 'play' カテゴリに属するポストを取得
        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id); // カテゴリIDを明示的に指定
        })->latest()->paginate(6); // ページネーションを適用

        return view('posts.play', compact('posts'));
    }

    public function watchAndLearn()
    {
        $category = Category::where('name', 'Watch and Learn')->first();

        if (!$category) {
            return redirect()->route('posts.schedule')->with('error', 'Watch and Learn category not found.');
        }

        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->latest()->paginate(6);
        
        return view('posts.watch-and-learn', compact('posts'));
    }

    public function eat()
    {
        $category = Category::where('name', 'eat')->first();

        if (!$category) {
            return redirect()->route('posts.schedule')->with('error', 'Eat category not found.');
        }

        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->latest()->paginate(6);
        
        return view('posts.eat', compact('posts'));
    }

    public function others()
    {
        $category = Category::where('name', 'others')->first();

        if (!$category) {
            return redirect()->route('posts.schedule')->with('error', 'Others category not found.');
        }

        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->latest()->paginate(6);
        
        return view('posts.others', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // クエリが空でない場合のみ検索
        if ($query) {
            $posts = Post::where('title', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%')
                ->get();
        } else {
            $posts = Post::all();  // クエリが空の場合は全件取得
        }

        return view('posts.posts', compact('posts', 'query'));
    }

    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('posts.schedule')->with('success', 'Post deleted successfully.');
    }


}
