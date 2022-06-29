<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
        $this->middleware('auth.post')->only(['edit', 'update', 'destroy']);
    }


    public function index()
    {
        //
        $posts = Post::with(['tags', 'category', 'author'])->get();

        return view('post.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', ['categories' => $categories, 'tags'=> $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'string|max:255|required',
            'body' => 'string|required',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        $category = Category::where('slug', $request->category_slug)->firstOrFail();
        $tags = Tag::whereIn('id', $request->tags)->get();

        $auth_user = auth()->user();

        $post = new Post();
        if($request->image != null){
            $image_path= $request->file('image')->storePublicly('posts');
            move_uploaded_file($image_path, public_path('image'));
            $post->image_path = $image_path;
        }


        $post->title = Str::title($request->title);
        $post->slug = Str::slug($request->title) . '-' . Str::random(4);
        $post->body = $request->body;
        $post->category()->associate($category);
        $post->author()->associate($auth_user);

        $post->save();
        $post->tags()->sync($tags);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //

        // $post = Post::with('author', 'category', 'tags')->find($post->id);

        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //

        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'title' => 'string|max:255|required',
            'body' => 'string|required',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        $category = Category::where('slug', $request->category_slug)->firstOrFail();
        $tags = Tag::whereIn('id', $request->tags)->get();

        $post = Post::findOrfail($post->id);
        if($request->file('image') != null){
            if($post->image_path != null){
                Storage::delete($post->image_path);

            }
                $image_path= $request->file('image')->storePublicly('posts');
                move_uploaded_file($image_path, public_path('image'));
                $post->image_path = $image_path;
        }



        $post->title = Str::title($request->title);
        $post->slug = Str::slug($request->title) . '-' . Str::random(4);
        $post->body = $request->body;
        $post->category()->associate($category);
        $post->tags()->sync($tags);
        $post->save();

        return redirect()->route('post.show', ['post' => $post->id ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //

        $post = Post::findOrFail($post->id);
        if($post->image_path != null){
          Storage::delete($post->image_path);
        }

        $post->delete();

        return redirect()->route('post.index');
    }

    public function category($id)
    {
        //
        // $categorys = category::findOrFail($id);
        $posts = Post::where('category_id', $id)->get();
        $category = Category::find(1);

        return view('post.category', ['posts'=> $posts, 'category'=> $category]);
    }
}
