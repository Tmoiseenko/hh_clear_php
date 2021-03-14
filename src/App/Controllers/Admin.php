<?php

namespace App\Controllers;

use App\Views\View;
use App\Controllers\Post;
use App\Controllers\Category ;
use App\Controllers\Page;
use App\Controllers\Comment;
use App\Controllers\Subscribe;
use App\Controllers\Setting;
use App\Controllers\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException as QE;

class Admin
{
    static public function getIndex()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            return new View('admin.index', [
                'title'  =>  'Admin Panel',
            ]);
        } else {
            return header("Location: /login");
        }

    }

    static public function getModel($model)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            switch ($model){
                case 'post':
                    return Post::getAll(true);
                case 'page':
                    return Page::getAll(true);
                case 'user':
                    return User::getAll(true);
                case 'category':
                    return Category::getAll(true);
                case 'subscribe':
                    return Subscribe::getAll(true);
                case 'comment':
                    return Comment::getAll(true);
                case 'setting':
                    return Setting::getAll(true);
            }
        } else {
            return header("Location: /login");
        }
    }




}
