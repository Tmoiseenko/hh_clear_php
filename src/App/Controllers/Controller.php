<?php

namespace App\Controllers;

use App\Views\View;

class Controller
{
    static public function extra($param1, $param2)
    {
        return new View('index', [
            'title' => 'Test parametrs second',
            'content' => "Test page whith param1=$param1 and parm2=$param2"]);
    }

    static public function index()
    {
        echo "home";
    }

    static public function about()
    {
        echo "about";
    }

}
