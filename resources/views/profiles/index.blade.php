@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Profile Info -->
    <div class="row">
        <div class="col-md-3">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Avatar" class="rounded-circle w-50">
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create" class="btn btn-primary">Add New Post</a>

            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>150</strong> posts</div>
                <div class="pr-4"><strong>15k</strong> followers</div>
                <div class="pr-4"><strong>1000</strong> following</div>
            </div>
            <div class="pt-3">
                <div class="font-weight-bold">{{ $user->profile->title }}</div>
                <p>{{ $user->profile->description }}</p>
                @if ($user->profile->url)
                    <p><a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a></p>
                @else
                    <p>N/A</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Profile Info -->

    <!-- Posts -->
    <div class="row pt-5">
        <div class="col-md-4">
            <img src="https://w0.peakpx.com/wallpaper/40/935/HD-wallpaper-nature-beautiful.jpg" class="w-100 mb-4 rounded">
        </div>
        <div class="col-md-4">
            <img src="https://images.pexels.com/photos/2486168/pexels-photo-2486168.jpeg" class="w-100 mb-4 rounded">
        </div>
        <div class="col-md-4">
            <img src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTA5L3Jhd3BpeGVsX29mZmljZV8zM193YWxscGFwZXJfcGF0dGVybl9vZl9wYXN0ZWxfY29sb3JlZF9wZW5jaWxfdF9kNzIzNTM5YS1iMDJiLTQ0ZmItYjA5Zi1mNzQwNjMxYjM1NTNfMS5qcGc.jpg" class="w-100 mb-4 rounded">
        </div>
    </div>
    <!-- Posts -->
</div>
@endsection
