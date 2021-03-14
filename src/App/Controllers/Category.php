<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\Category as CategoryModel;

class Category
{

    static public function getAll($adminTmp = false)
    {
        if (isset($_GET['order_by'])) {
            $objects = CategoryModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = CategoryModel::all();
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
        $template = $adminTmp ? 'admin.get-all-category' : 'index' ;
        return new View($template, [
            'title'  =>  "Все категории",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'category'
        ]);
    }

    static public function createNewCategoryFromPost($name)
    {
        $category = CategoryModel::firstOrNew(['name' => $name]);
        $category->save();
        return $category->id;
    }

    static public function getAllCategory()
    {
        $category = CategoryModel::all();
        if ($category->count() != 0){
            return $category;
        } else {
            return [];
        }
    }

    static public function createCategory()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            return new View('admin.categoryCreate', [
                'title'  =>  'Создание Категории',
            ]);
        } else {
            return header("Location: /login");
        }
    }

    static public function saveCategory()
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createCategory'])) {
                $category = htmlspecialchars($_POST['category']);
                try {
                    $post = CategoryModel::firstOrNew(['name' => $category]);
                    $post->save();
                    return header("Location: /admin/category");
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

    static public function getUpdateCategory($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            try {
                $category = CategoryModel::findOrFail($id);
                return new View('admin.categoryUpdate', [
                    'title'  =>  'Обновление категории',
                    'category'  => $category,
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

    static public function saveUpdateCategory($model, $id)
    {
        if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true){
            if (isset($_POST['createCategory'])) {
                $category = htmlspecialchars($_POST['category']);
                try {
                    $post = CategoryModel::findOrFail($id);
                    $post->name = $category;
                    $post->save();
                    return header("Location: /admin/category");
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
