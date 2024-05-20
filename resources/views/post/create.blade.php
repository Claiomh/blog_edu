@extends('layouts.main')
@section('content')
    <form action="{{route('post.store')}}" method="post">
@csrf
        <input type="text" name="title" placeholder="title">
        <textarea name="content" placeholder="Content"></textarea>
        <input type="text" name="image" placeholder="image">
        <input type="text" name="slug" placeholder="slug">

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
