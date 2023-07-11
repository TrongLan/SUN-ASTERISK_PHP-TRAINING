<?php

class Controller
{
    function loadModel($model)
    {
        require_once "./app/models/" . $model . ".php";
        return new $model();
    }

    function loadView($view, $dto=[])
    {
        require_once "./app/views/" . $view . ".php";
    }


}
