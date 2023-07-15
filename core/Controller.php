<?php

class Controller
{
    public function loadModel($model)
    {
        require_once "./app/models/" . $model . ".php";
        return new $model();
    }

    public function loadView($view, $dto = [])
    {
        require_once "./app/views/" . $view . ".php";
    }


    public function loginRequire()
    {
        if ($this->isNotLoggedIn()) {
            header("Location: /login");
            exit();
        }
    }

    /**
     * @return bool
     */
    public function isNotLoggedIn()
    {
        return !isset($_SESSION['user_id']) && !isset($_COOKIE['remember_me']);
    }

}
