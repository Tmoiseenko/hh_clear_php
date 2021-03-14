<?php

namespace App\Controllers;

use App\Models\Subscribe as SubscribeModel;
use App\Views\View;
use App\Models\Setting;

class Subscribe
{
    static public function getAll($adminTmp = false)
    {
        if (isset($_GET['order_by'])) {
            $objects = SubscribeModel::orderBy($_GET['order_by'], $_GET['order'])->get();
        } else {
            $objects = SubscribeModel::all();
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
        $template = $adminTmp ? 'admin.get-all-subscribe' : 'index' ;
        return new View($template, [
            'title'  =>  "Все Подписчики",
            'objects'   =>  $objects,
            'num_pages' => $num_pages,
            'page' => $page,
            'current_page' => $current_page,
            'model' => 'subscribe'
        ]);
    }

    static public function add()
    {
        $email = $_POST['subscribe'];
        try {
            $subscribe = SubscribeModel::firstOrCreate(['email' => $email]);
            if (isset($_SESSION['user_info']['email']) && $email === $_SESSION['user_info']['email']){
                $_SESSION['subscribe'] = true;
            }
            return new View('subscribe', [
                'title'  =>  'Подписка',
                'subscriber'    => $subscribe->email
            ]);
        } catch (\Exception $e){
            return new View('404', [
                'title'  =>  'Упс кажется такой страницы нет',
                'e'    => $e
            ]);
        }
    }

    static public function checkSubsriber($email)
    {
        $subscriber = SubscribeModel::where('email', $email)->first();
        if ($subscriber != null) {
            return true;
        } else {
            return false;
        }
    }

    static public function delete($model, $id)
    {
        $delete = SubscribeModel::destroy($id);
        return static::getAll(true);
    }

    static public function unsubscribe($model, $email)
    {
        SubscribeModel::where('email', '=', $email)->delete();
        unset($_SESSION['subscribe']);
        return new View('unsubscribe', [
            'title'  =>  'Подписка',
            'subscriber'    => $email
        ]);
    }

    static public function notify($obj)
    {
        $emails = SubscribeModel::all()->pluck('email');
        $file = APP_DIR . 'logs/emails.txt';
        foreach ($emails as $email) {
            $text  = "Получатель: " . $email . " -- дата отпрвки: " . date('Y/m/d H:i' . PHP_EOL);
            $text .= "Заголовок письма: На сайте добавлена новая запись: '$obj->title'" . PHP_EOL;
            $text .= "Новая статья: '$obj->title'," . PHP_EOL;
            $text .= excerpt($obj->content) . PHP_EOL;
            $text .= "HOME_URL/post/" . $obj->id . PHP_EOL;
            $text .= "**********************************************************************" . PHP_EOL;
            file_put_contents($file, $text, FILE_APPEND);
        }

    }
}
