<?php

namespace App\Views;

class View implements \App\Interfaces\Renderable
{
    private $template;
    private $args;

    public function __construct($template, $args)
    {
        $this->template = $template;
        $this->args = $args;
    }

    public function render()
    {
        extract($this->args);
        require VIEW_DIR . '/' . str_replace('.', '/', $this->template) . '.php';
    }
}
