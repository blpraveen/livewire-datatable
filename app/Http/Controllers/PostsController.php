<?php

namespace App\Http\Controllers;


class PostsController extends Controller
{
    
    public function posts() {
        return view('posts');
    }
}
