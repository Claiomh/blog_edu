@extends('layouts.main')
@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post">
        @csrf
        @method('patch')
        <input type="text" name="title" placeholder="title" value="{{$post->title}}">
        <textarea name="content" placeholder="Content">{{$post->content}}</textarea>
        <input type="text" name="image" placeholder="image" value="{{$post->image}}">
        <input type="text" name="slug" placeholder="slug" value="{{$post->slug}}">
        <select name="category_id" id="category">
            @foreach($categories as $category)
                <option
                    {{$category->id === $post->category->id ? 'selected' : ''}}
                    value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <select multiple name="tags[]" id="tags">
            @foreach($tags as $tag)

                <option
                    @foreach($post->tags as $post_tag)
                        {{$tag->id === $post_tag->id ? 'selected' : ''}}
                    @endforeach
                    value="{{ $tag->id }}">{{ $tag->title }}</option>

            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
