<?php

class App
{

    private $controller;
    private $action;
    private $params;

    public function __construct()
    {
        $this->controller = "Home";
        $this->action = "index";
        $this->params = [];

        $this->requestHandling();
    }

    public function getUrl()
    {
        if (!empty($_SERVER["PATH_INFO"])) {
            $url = trim($_SERVER["PATH_INFO"]);
        } else {
            $url = "/";
        }
        return $url;
    }

    public function loadError($code = "404")
    {
        require_once "errors/" . $code . ".php";
    }

    public function requestHandling()
    {
        $urlComponents =
            array_values(
                array_filter(explode("/", $this->getUrl())));
        if (!empty($urlComponents[0])) {
            $this->controller = ucfirst(trim($urlComponents[0]));
            unset($urlComponents[0]);
        }
        $filename = "app/controllers/" . ($this->controller) . ".php";
        if (file_exists($filename)) {
            require_once $filename;
            $this->controller = new $this->controller();
        } else {
            $this->loadError();
        }

        if (isset($urlComponents[1])) {
            if (method_exists($this->controller, $urlComponents[1])) {
                $this->action = trim($urlComponents[1]);
            } else {
                $this->loadError();
            }
            unset($urlComponents[1]);
        }

        $this->params = $urlComponents ? array_values($urlComponents) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }
}
