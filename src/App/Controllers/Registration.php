<?php

namespace App\Controllers;

use App\Controllers\Authorization;
use App\Controllers\User as C_User;
use App\Models\User;
use App\Views\View;

class Registration
{
    static public function getRegisterForm()
    {
        if (!isset($_SESSION["is_auth"]) || $_SESSION["is_auth"] !== true) {
            return new View('registration', [
                'title' => 'Регистрация'
            ]);
        } else {
            if ($_SESSION['user_info']['role'] == 'administrator' || $_SESSION['user_info']['role'] == 'moderator'){
                return header("Location: /admin");
            } else {
                return header("Location: /");
            }
        }
    }

    static public function register()
    {
        if (isset($_POST['register'])) {
            $error = static::checkData($_POST);
            if ($error === []) {
                $options = [
                    'login' =>  htmlspecialchars($_POST['login']),
                    'email' =>  $_POST['email'],
                    'password'  =>  password_hash($_POST['password'], PASSWORD_BCRYPT),
                    'role_id'   =>  3
                ];
                $chekUser = C_User::chekUserLogin($options['login']);
                if (!C_User::chekUserLogin($options['login'])){
                    try {
                        $user = User::firstOrNew($options);
                        $user->save();
                        Authorization::login();
                    } catch (\Exception $e){
                        return $e->getMessage();
                    }
                } else {
                    $error[] = 'Данный логин уже существует';
                    return new View('registration', [
                        'title' => 'Регистрация',
                        'error' => $error
                    ]);
                }

            } else {
                return new View('registration', [
                    'title' => 'Регистрация',
                    'error' => $error
                ]);
            }


        }
    }

    static public function checkData(array $post)
    {
        $error = [];
        if ($post['password'] != $post['confirm']) {
            $error[] = 'Введеные пароли не совпадают.';
        }
        if (!isset($post['agreement'])) {
            $error[] = 'Вы не согласились на обработку персональных данных и правилами сайта.';
        }
        return $error;
    }

}
