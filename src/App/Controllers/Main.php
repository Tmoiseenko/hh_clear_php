<?php

namespace App\Controllers;

use App\Views\View;
//use App\Models\Post;
use App\Controllers\Post;
use App\Models\Setting;
use App\Models\Category;

class Main
{
    static public function getIndex()
    {
        return Post::getAll();
    }
}
