@extends('layouts.main')
@section('content')
    <form action="{{route('post.store')}}" method="post">
        @csrf
        <input type="text" name="title" placeholder="title" value="{{ old('title') }}">
        @error('title')
        <p>danger</p> {{ $message }}
        @enderror
        <textarea name="content" placeholder="Content"></textarea>
        <input type="text" name="image" placeholder="image">
        <input type="text" name="slug" placeholder="slug">
        <select name="category_id" id="category">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <select multiple name="tags[]" id="tags">
            @foreach($tags as $tag)
            <option
                {{ old('category') == $category->id ? 'selected' : '' }}
                value="{{ $tag->id }}">{{ $tag->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
