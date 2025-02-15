<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
       $message ="Welcome to the Demo Page!";
       return view('demo', ['message' => $message]);
    }

    public function greet($name)
    {
        return 'Hello ' . $name . '! Welcome to the Demo Page!';
    }
}
