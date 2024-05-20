@extends('layouts.main')
@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post">
@csrf
        @method('patch')
        <input type="text" name="title" placeholder="title" value="{{$post->title}}">
        <textarea name="content" placeholder="Content">{{$post->content}}</textarea>
        <input type="text" name="image" placeholder="image" value="{{$post->image}}">
        <input type="text" name="slug" placeholder="slug" value="{{$post->slug}}">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
