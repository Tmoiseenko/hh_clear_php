<?php

namespace App\Controllers;

use App\Models\User as UserModel;
use App\Models\Role;
use App\Views\View;

class User
{
    static public function getAll($adminTmp = false)
    {
        if (isset($_GET['order_by'])) {
            $objects = UserModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = UserModel::all();
        }
        $base_per_page = \App\Models\Setting::where('slug', '=', "per_page_admin")->firstOrFail();
        $per_page = $_GET['per_page'] ?? ($base_per_page->value ?? '3');
        $current_page = 1;
        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $current_page = $_GET['page'];
        }
        $start = ($current_page - 1) * $per_page;
        $rows = $objects->count();
        $num_pages = ceil($rows / $per_page);
        $page = 0;
        $objects = $objects->skip($start)->take($per_page);
        $template = $adminTmp ? 'admin.get-all-user' : 'index' ;
        return new View($template, [
            'title'  =>  "Все пользователи",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'user'
        ]);
    }

    static public function getUser($id)
    {
        try {
            $user = UserModel::find($id);
            return $user;
        } catch (\Exception $e) {
            return new View('404', [
                'title'  =>  'Упс кажется такой страницы нет',
                'e'    => $e
            ]);
        }
    }

    static public function getEditRole($model, $id)
    {
        return new View('admin.editRole', [
            'title'  =>  'Изменение роли пользователя',
            'user'    => UserModel::findOrFail($id),
            'roles'    => Role::all()
        ]);
    }

    static public function saveEditRole($model, $id)
    {
        $role = Role::findOrFail((int) $_POST['role']);
        $user = UserModel::findOrFail($id);
        $user->role()->associate($role);
        $user->save();
        return header("Location: /admin/user");
    }

    static function chekUserLogin($login)
    {
        $user = UserModel::where('login', $login)->get();
        return $user->count();
    }
}
