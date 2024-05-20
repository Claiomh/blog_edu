@extends('layouts.main')
@section('content')

        <div>
            {{$post->title}}</div>
          <div> {{$post->content}}</div>
<div><a href="{{route('post.index')}}">back</a></div>
        <a href="{{route('post.edit', $post->id)}}">edit</a>
        <form action="{{route('post.delete', $post->id)}}" method="post">
            @csrf
            @method('delete')
        <button type="submit">Delete</button>
        </form>

@endsection
