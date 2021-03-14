<?php

namespace App;

use App\Interfaces\Renderable;
use App\Config as Config;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->initialize();
    }

    public function run()
    {
        try {
            $dispatch = $this->router->dispatch();
            if (is_a($dispatch, Renderable::class)) {
                $dispatch->render();
            }
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    public function renderException(\Exception $error) {
        if ($error instanceof Renderable) {
            $error->render();
        } else {
            throw new \Exception();
        }
    }

    public function initialize()
    {
        $config = Config::getInstance();
        $dbsettings = $config->get('db.mysql');
        $capsule = new Capsule;
        if ($dbsettings !== null) {
            $capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $dbsettings['host'],
                'database'  => $dbsettings['name'],
                'username'  => $dbsettings['user'],
                'password'  => $dbsettings['password'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        } else {
            throw new \Exception('Не удалось подключиться к базе', 500);
        }


    }

}
