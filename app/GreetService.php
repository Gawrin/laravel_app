<?php

namespace App;

class GreetService
{
    public function greet($name)
    {
        return "Hello, $name! This message is from GreetService.";
    }
}