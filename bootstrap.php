<?php

define('APP_DIR',     $_SERVER['DOCUMENT_ROOT'] . '/');
define('HOME_URL',     (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']);
define('VIEW_DIR', $_SERVER['DOCUMENT_ROOT'] . '/View');
define('UPLOAD_DIR', '/public/uploaded/');

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once __DIR__ . '/helpers.php';
