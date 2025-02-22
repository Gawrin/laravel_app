<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeTestController extends Controller
{
    public function index()
    {
        $username = 'John Doe';
        $isLoggedIn = true;
        $tasks = ['Fix server issue', 'Update documentation', 'Review pull requests'];
        $rawHtml = '<strong>This is raw HTML and will not be escaped.</strong>'; // Added this variable

        return view('bladetest', compact('username', 'isLoggedIn', 'tasks', 'rawHtml'));
    }
}
