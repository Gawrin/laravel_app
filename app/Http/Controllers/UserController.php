<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'Hello World';
    }

    public function show($id)
    {
        // Fetch user data from the database or any other source
        $user = [
            'name' => 'John Doe',
            'age' => 30,
            'email' => 'john.doe@example.com',
            'id' => $id
        ];

        // Pass the user data to the view
        return view('user', $user);
    }
}
