

@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($posts->isEmpty())
            <p>No posts available.</p>
        @else
            @foreach ($posts as $post)
                <div class="post">
                    <h2>{{ $post->caption }}</h2>
                    <p>Posted by: {{ $post->user->name }}</p> <!-- Display author's name -->
                    <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}" width="100">
                    <p>Posted on: {{ $post->created_at->format('M d, Y') }}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection
