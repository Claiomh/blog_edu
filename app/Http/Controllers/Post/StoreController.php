<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function __invoke(Request $request)
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

//dd($data);
        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }


}