<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string',
            'category_id' => 'integer',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);


        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        //$post->load('tags');
//        dd($post);
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $tags = Tag::all();
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string',
            'category_id' => 'integer',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id, );

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
