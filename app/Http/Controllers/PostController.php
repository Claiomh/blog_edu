<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        $posts = Post::all();
        $category = Category::find(1);
        $post = Post::find(4);
        dd($post->category);
    }

    public function create()
    {
        return view('post.create');

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string'
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string'
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);

    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(3);
        $post->delete();
        dump('deleted');
    }
    //firstOfCreate Для уникальных и проверка на существование
    //updateOfCreate

    public function firstOrCreate()
    {
        $another_post = [
            'title' => '121231231',
            'content' => '123123123',
            'image' => 'asdfasdfasdf',
            'slug' => 'sdfasdf',
            'likes' => 10,
            'is_published' => 1
        ];
        $myPost = Post::firstOrCreate(['title' => $another_post['title'],],
            [
                'content' => '123123123',
                'image' => 'asdfasdfasdf',
                'slug' => 'sdfasdf',
                'likes' => 10,
                'is_published' => 1
            ]);
    }

    public function updateOrCreate()
    {
        $another_post = [
            'title' => '12asdfasdf1231231',
            'content' => '12asfdasdf3123123',
            'image' => 'asdasdffasdfasdf',
            'slug' => 'sdfasdf',
            'likes' => 100,
            'is_published' => 1
        ];
        Post::updateOrCreate(['title' => $another_post['title'],], $another_post);
    }

}
