<?php

class View {

    protected $data;

    protected $path;

    protected static function getViewPath(){
        $router = App::getRouter();

        if (!$router){
            return false;
        }

        $controller_dir = $router->getController();
        $template_name = $router->getMethodPrefix() . $router->getAction() . '.html';

        return VIEWS_PATH . DS . $controller_dir . DS . $template_name;
    }

    public function __construct($data = array(), $path = null){
        if(!$path){
            $path = self::getViewPath();
        } if (!file_exists($path)){
            throw new Exception('There is no file in path: ' . $path);
        }

        $this->path = $path;
        $this->data = $data;
    }

    public function render(){
        $data = $this->data;

        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }

}