<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $tags = Tag::all();
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id, );

    }

}
