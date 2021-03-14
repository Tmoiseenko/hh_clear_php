<?php

namespace App\Controllers;

use App\Models\Comment as CommentModel;
use App\Models\User;
use App\Views\View;

class Comment
{
    static public function getAll($adminTmp = falsee)
    {
        if (isset($_GET['order_by'])) {
            $objects = CommentModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = CommentModel::orderBy('moderate', 'ASC')->get();
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
        $template = $adminTmp ? 'admin.get-all-comment' : 'index' ;
        return new View($template, [
            'title'  =>  "Все комментарии",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'comment'
        ]);
    }

    static public function saveComment($id)
    {
        unset($_SESSION['comment_warning']);
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true) {
            $role = ['administrator', 'moderator'];
            $user = User::where('login', $_SESSION ["user_info"]["login"])->first();
            $comment = new CommentModel;
            $comment->text = htmlspecialchars($_POST['message']);
            $comment->post_id = $id;
            $comment->user_id = $user->id;
            $comment->moderate = in_array($_SESSION ["user_info"]["role"], $role) ? 1 : 0;
            $comment->save();
            $ref = $_SERVER["HTTP_REFERER"];
            $warning = "comment_warning_$id";
            $_SESSION["comment_warning"][$warning] = ['error' => 'Ваш комментарий отправлен на модерацию',
                                            'error_class' => 'info'];
            return header("Location: $ref");
        } else {
            $ref = $_SERVER["HTTP_REFERER"];
            $warning = "comment_warning_$id";
            $_SESSION["comment_warning"][$warning] = ['error' => 'Пожалуйста авторизуйтесь',
                                            'error_class' => 'danger'];
            return header("Location: $ref");
        }
    }

    static public function confirmComment($model, $id)
    {
        $comment = CommentModel::findOrFail($id);
        $comment->moderate = 1;
        $comment->save();
        $ref = $_SERVER["HTTP_REFERER"];
        return header("Location: $ref");
    }
}
