<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required','image'],

        ]);

        dd($request->all());
    }
}
