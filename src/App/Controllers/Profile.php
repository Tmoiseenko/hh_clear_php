<?php

namespace App\Controllers;

use App\Controllers\User;
use App\Views\View;

class Profile
{
    static public function getProfile($login)
    {
        $user = User::getUser($login);
        return new View('profile', [
            'title'  =>  "Профиль пользователя",
            'profile'   =>  $user,
            'subscribe' => Subscribe::checkSubsriber($user->email)
        ]);
    }

    static public function editProfileForm($login)
    {
        $user = User::getUser($login);
        return new View('edit_profile', [
            'title'  =>  "Редактирование профиля пользователя",
            'profile'   =>  $user,
        ]);
    }

    static public function editProfile($login)
    {
        if (isset($_POST['editProfile'])) {
            $user = User::getUser($login);
            if (password_verify($_POST['password'], $user->password)) {
                $login = htmlspecialchars($_POST['login']) != $user->email ? htmlspecialchars($_POST['login']) : $user->email;
                $fio = htmlspecialchars($_POST['fio']) != $user->email ? htmlspecialchars($_POST['fio']) : $user->fio;
                $newPassword = $_POST['newPassword'] != '' ? password_hash($_POST['newPassword'], PASSWORD_BCRYPT) : $user->password;
                $email = $_POST['email'] != $user->email ? $_POST['email'] : $user->email;
                $about = htmlspecialchars($_POST['about']) != $user->about ? htmlspecialchars($_POST['about']) : $user->about;

                if (isset($_FILES) && $_FILES['image']['name'] !== ''){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    if ($image) {
                        if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . UPLOAD_DIR . $_FILES['image']['name'], $image)){
                            $avatar = UPLOAD_DIR . $_FILES['image']['name'];
                        }
                    }
                }

                $user->fio = $fio;
                $user->email = $email;
                $user->login = $login;
                $user->password = $newPassword;
                $user->avatar = $avatar ?? '';
                $user->about = $about;
                $user->save();
                return header("Location: /profile/$user->id");
            } else {
                return new View('edit_profile', [
                    'title'  =>  "Редактирование профиля пользователя",
                    'error'  => 'Введен не верный пароль',
                    'profile'   =>  $user,

                ]);
            }
        }

    }
}
