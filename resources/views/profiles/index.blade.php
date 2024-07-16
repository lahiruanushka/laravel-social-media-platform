
@extends('layouts.app')
@section('content')

<div class="container">
    <!-- Profile Info -->
    <div class="row">
        <div class="col-md-3 text-center">

<img  src="{{ asset($user->profile->profileImage()) }}" alt="Avatar" class="rounded-circle img-fluid mb-3">

            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit" class="btn btn-outline-primary btn-block">Edit Profile</a>

            <a href="/p/create" class="btn btn-outline-primary btn-block">Add New Post</a>
            @endcan
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-baseline mb-3">
                <div>
                    <div class="d-flex align-items-center">
                        <h1 class="h4 p-2">{{ $user->username }}</h1>    
                    </div>
                    
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
                <a href="/p/{{$post->id}}">
<img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded" alt="Post Image">
                                        
                </a>
            </div>
        </div>
        @endforeach   
    </div>
    <!-- Posts -->
</div>
@endsection
