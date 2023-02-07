<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);
        $validated['user_id'] = auth()->user()->id;

        // $request->user()->posts()->create($validated);
        Post::create($validated);
        return redirect()->back()->with('success', 'success create post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd(Comment::with('user')->where('post_id', $post->id)->latest()->get());
        // dd(Comment::with('user', 'posts')->where('post_id', $post->id)->get());

        // echo "ini detail $post";
        return view('posts.detail', [
            'post' => Post::with('user', 'comments')->where('id', $post->id)->first(),
            // 'post' => Post::with('user', 'comments')->first(),
            // 'posts' => Post::with('comments', 'user')->latest()->get()
            'comments' => Comment::with('user')->where('post_id', $post->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
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
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $post->update($validated);
        return redirect()->to('/home')->with('success', 'success Update post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->to('/home')->with('success', 'success Delete post');
    }
}
