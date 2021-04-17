<?php
namespace Core\Controller;

use Core\Sys\Config;

class Controller
{
    protected $viewPath;
    protected $layout="layout/Layout";
    protected $router;
    public function __construct()
    {
        $this->viewPath=Config::$View;
    }
    public function render($view,$params=[])
    {
        ob_start();
        extract($params);
        require_once $this->viewPath.$view.".php";
        $containe=ob_get_clean();
        require_once $this->viewPath.$this->layout.".php";
    }
}