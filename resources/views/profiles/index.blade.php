@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Profile Info -->
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="{{ $user->profile->image ? asset('storage/' . $user->profile->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" alt="Avatar" class="rounded-circle img-fluid mb-3">
            <h1 class="h4">{{ $user->username }}</h1>
            <a href="/p/create" class="btn btn-outline-primary btn-block">Add New Post</a>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-baseline mb-3">
                <div>
                    <h1 class="h4 mb-1">{{ $user->username }}</h1>
                    <div class="d-flex flex-wrap">
                        <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                        <div class="pr-4"><strong>15k</strong> followers</div>
                        <div class="pr-4"><strong>1000</strong> following</div>
                    </div>
                </div>
                <a href="/p/create" class="btn btn-primary d-md-none">Add New Post</a>
            </div>
            <div class="pb-3">
                <h2 class="h5 font-weight-bold">{{ $user->profile->title }}</h2>
                <p>{{ $user->profile->description }}</p>
                @if ($user->profile->url)
                    <p><a href="{{ $user->profile->url }}" target="_blank">{{ $user->profile->url }}</a></p>
                @else
                    <p>N/A</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Profile Info -->

    <!-- Posts -->
    <div class="row pt-4">
        @foreach($user->posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded" alt="Post Image">
            </div>
        </div>
        @endforeach   
    </div>
    <!-- Posts -->
</div>
@endsection
