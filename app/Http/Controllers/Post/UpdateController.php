<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(Post $post)
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

}
