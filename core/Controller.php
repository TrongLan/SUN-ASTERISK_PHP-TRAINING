<?php

class Controller
{
    function loadModel($model)
    {
        require_once "./app/models/" . $model . ".php";
        return new $model();
    }

    function loadView($view)
    {
        require_once "./app/views/" . $view . ".php";
        return new $view();
    }


}
