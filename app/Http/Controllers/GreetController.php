<?php

namespace App\Http\Controllers;

use App\GreetService;

class GreetController extends Controller
{
    protected $greetService;

    public function __construct(GreetService $greetService)
    {
        $this->greetService = $greetService;
    }

    public function __invoke()
    {
        $name = request('name', 'Guest');
        return $this->greetService->greet($name);
    }
}