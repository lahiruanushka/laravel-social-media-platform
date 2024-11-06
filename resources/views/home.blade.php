@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Post Image Section -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <img src="{{ asset($post->image) }}" class="img-fluid card-img-top rounded" alt="{{ $post->caption }}">
                </div>
            </div>

            <!-- Post Details Section -->
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">

                        </div>
                    @endsection
