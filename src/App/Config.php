<?php

namespace App;

use FilesystemIterator;

final class Config
{
    private static $instance;
    private $configs;

    private function __construct()
    {
        $path = APP_DIR . "/configs";
        $iterator = new FilesystemIterator("./configs");
        $filelist = array();
        foreach($iterator as $entry) {
            $filelist[] = $entry->getFilename();
        }
        foreach ($filelist as $file) {
            list($filename, $expansion) = explode('.', $file);
            $this->configs[$filename] = include_once $path . '/' . $filename . '.' . $expansion;
        }
    }

    static public function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function get($config, $default = null)
    {
        return array_get($this->configs, $config, $default);
    }
}
