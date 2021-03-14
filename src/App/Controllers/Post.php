<?php

namespace App\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category as CatModel;
use App\Controllers\Category;
use App\Controllers\Subscribe;
use App\Views\View;
use App\Models\Post as PostModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException as QE;

class Post
{
    static public function getAll($adminTmp = false)
    {
        if (isset($_GET['order_by'])) {
            $objects = PostModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = PostModel::orderBy('created_at', 'DESC')->get();
        }

        $base_per_page = Setting::where('slug', '=', $adminTmp ? "per_page_admin" : "per_page_front")->firstOrFail();
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
        $template = $adminTmp ? 'admin.get-all-post' : 'index' ;
        return new View($template, [
            'title'  =>  "Все посты",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'post'
        ]);
    }

    static public function getPost($id)
    {
        try {
            $comment = Comment::where(['post_id' => $id, 'moderate' => 1])->get();
            $post = PostModel::findOrFail($id);
            return new View('post', [
                'title'  =>  $post->title,
                'post'  => $post,
                'comments' => $comment,
                'comment_count' => $comment->count()
            ]);
        } catch (ModelNotFoundException $e) {
            return new View('404', [
                'title'  =>  'Упс кажется такой страницы нет',
                'e'    => $e
            ]);
        } catch (\Exception $e) {
            return new View('404', [
                'title'  =>  'Упс кажется такой страницы нет',
                'e'    => $e
            ]);
        }
    }

    static public function createPost()
    {
        try {
            $category = Category::getAllCategory();
        } catch (QE $e) {
            $category = false;
        }

        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            return new View('admin.postCreate', [
                'title'  =>  'Создание Пост',
                'categories'    => $category
            ]);
        } else {
            return header("Location: /login");
        }

    }

    /**
     * @return View|void
     */
    static public function savePost()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createPost'])) {
                if (isset($_FILES)){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    if ($image) {
                        if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . UPLOAD_DIR . $_FILES['image']['name'], $image)){
                            $imagePath = UPLOAD_DIR . $_FILES['image']['name'];
                        }
                    }
                }

                if(isset($_POST['addCategory'])){
                    $cat_id = Category::createNewCategoryFromPost(htmlspecialchars($_POST['addCategory']));
                }
                $user = User::where('login', $_SESSION ["user_info"]["login"])->get();
                $cat = User::findOrFail((int) $_POST['category']);
                $prop = [
                    'title' => htmlspecialchars($_POST['title']),
                    'slug' => htmlspecialchars(translit($_POST['title'])),
                    'content' => htmlspecialchars($_POST['content']),
                    'category_id' => $cat_id ?? (int) $_POST['category'],
                    'image' => $imagePath ?? '',
                ];
                try {
                    $post = PostModel::firstOrNew($prop);
                    $post->user()->associate($user[0]);
                    $post->category()->associate($cat);
                    $post->save();
                    static::notify($post);
                    return header("Location: /admin/post");
                } catch (\Exception $e){
                    return new View('404', [
                        'title'  =>  'Упс кажется такой страницы нет',
                        'e'    => $e
                    ]);
                }
            }
        } else {
            return header("Location: /login");
        }
    }

    static public function getUpdatePost($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            try {
                $post = PostModel::findOrFail($id);
                return new View('admin.postUpdate', [
                    'title'  =>  'Создание Пост',
                    'post'  => $post,
                    'categories'    => Category::getAllCategory(),
                ]);
            } catch (ModelNotFoundException $e) {
                return new View('404', [
                    'title'  =>  'Упс кажется такой страницы нет',
                    'e'    => $e
                ]);
            } catch (\Exception $e) {
                return new View('404', [
                    'title'  =>  'Упс кажется такой страницы нет',
                    'e'    => $e
                ]);
            }

        } else {
            return header("Location: /login");
        }
    }

    static public function saveUpdatePost($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createPost'])) {
                if (isset($_FILES) && $_FILES['image']['name'] !== ''){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    if ($image) {
                        if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . UPLOAD_DIR . $_FILES['image']['name'], $image)){
                            $imagePath = UPLOAD_DIR . $_FILES['image']['name'];
                        }
                    }
                }
                try {

                    $category = CatModel::findOrFail((int) $_POST['category']);
                    $post = PostModel::findOrFail($id);
                    $post->title = htmlspecialchars($_POST['title']);
                    $post->slug = htmlspecialchars($_POST['slug']);
                    $post->content = htmlspecialchars($_POST['content']);
                    $post->category()->associate($category);
                    if (isset($imagePath)) {
                        $post->image = $imagePath;
                    }
                    $post->save();
                    return header("Location: /admin/post");
                } catch (\Exception $e){
                    return new View('404', [
                        'title'  =>  'Упс кажется такой страницы нет',
                        'e'    => $e
                    ]);
                }
            }
        } else {
            return header("Location: /login");
        }
    }

    static public function getPostsForCategory($id)
    {
        $cat = CatModel::findOrFail($id);
        $objects = PostModel::where('category_id', $id)->orderBy('created_at', 'DESC')->get();
        $base_per_page = Setting::where('slug', '=', "per_page_front")->firstOrFail();
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
        return new View('index', [
            'title'  =>  "Посты в категории " . $cat->name,
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'post'
        ]);
    }

    static public function notify($message)
    {
        Subscribe::notify($message);
    }

}
