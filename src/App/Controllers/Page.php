<?php

namespace App\Controllers;

use App\Models\Page as PageModel;
use App\Models\Setting;
use App\Views\View;
use Illuminate\Database\QueryException as QE;

class Page
{
    static public function getAll($adminTmp = false)
    {
        if (isset($_GET['order_by'])) {
            $objects = PageModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = PageModel::all();
        }
        $base_per_page = Setting::where('slug', '=', "per_page_admin")->firstOrFail();
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
        $template = $adminTmp ? 'admin.get-all-page' : 'index' ;
        return new View($template, [
            'title'  =>  "Все страницы",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'page'
        ]);
    }

    static public function getPage($id)
    {
        try {
            $page = PageModel::findOrFail($id);
            return new View('page', [
                'title' => $page->title,
                'content' => $page->content,
            ]);
        } catch (ModelNotFoundException $e) {
            return new View('404', [
                'title' => 'Упс кажется такой страницы нет',
                'e' => $e
            ]);
        } catch (\Exception $e) {
            return new View('404', [
                'title' => 'Упс кажется такой страницы нет',
                'e' => $e
            ]);
        }
    }


    static public function createPage()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            return new View('admin.pageCreate', [
                'title'  =>  'Создание Страницы',
            ]);
        } else {
            return header("Location: /login");
        }

    }

    static public function savePage()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createPage'])) {

                $prop = [
                    'title' => htmlspecialchars($_POST['title']),
                    'slug' => translit($_POST['title']),
                    'content' => htmlspecialchars($_POST['content']),
                ];
                try {
                    $post = PageModel::firstOrNew($prop);
                    $post->save();
                    return header("Location: /admin/page");
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

    static public function getUpdatePage($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            try {
                $page = PageModel::findOrFail($id);
                return new View('admin.pageUpdate', [
                    'title'  =>  'Обновление Страницы',
                    'page'  => $page,
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

    static public function saveUpdatePage($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createPage'])) {
                try {
                    $post = PageModel::findOrFail($id);
                    $post->title = htmlspecialchars($_POST['title']);
                    $post->content = htmlspecialchars($_POST['content']);
                    $post->save();
                    return header("Location: /admin/page");
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

}
