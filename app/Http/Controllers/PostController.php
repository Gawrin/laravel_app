<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return "Displaying all posts.";
    }
    
    public function create()
    {
        return "Form to create a new post.";
    }
    
    public function store()
    {
        return "Storing a new post.";
    }
    
    public function show($id)
    {
        return "Displaying post with ID: $id.";
    }
    
    public function edit($id)
    {
        return "Form to edit post with ID: $id.";
    }
    
    public function update($id)
    {
        return "Updating post with ID: $id.";
    }
    
    public function destroy($id)
    {
        return "Deleting post with ID: $id.";
    }
    
}
