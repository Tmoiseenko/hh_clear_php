<?php

namespace App\Controllers;


use App\Views\View;
use App\Models\User;

class Honey
{
    static public function index()
    {
        $users = User::with('role')->get()->where('role_id', 3);
        return new View('honey', ['users' => $users]);
    }

    static public function save()
    {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment']))
        {
            $options = [
                'fio' => htmlspecialchars($_POST['name']),
                'email' => $_POST['email'],
                'about' => $_POST['comment'],
                'email' =>  $_POST['email'],
                'role_id'   =>  3
            ];
            $user = User::firstOrNew($options);
            $user->save();

        }
        $users = User::with('role')->get()->where('role_id', 3);
        return new View('layout.honey.comments', ['users' => $users]);
    }
}
