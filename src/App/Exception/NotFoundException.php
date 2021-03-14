<?php

namespace App\Exception;

use App\Interfaces\Renderable;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        $e = $this;
        require VIEW_DIR . '/404.php';
    }
}
