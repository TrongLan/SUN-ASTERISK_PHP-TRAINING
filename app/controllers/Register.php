<?php

class Register extends Controller
{
    function index()
    {
        $this->loadView("register_page", []);
        $userModel = $this->loadModel("User");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userModel->setEmail($_POST["email"]);
            $userModel->setFirstName($_POST["first-name"]);
            $userModel->setLastName($_POST["last-name"]);
            $userModel->setUsername($_POST["username"]);
            $userModel->setPassword($_POST["password"]);
            $userModel->saveUserInfo();
        }
    }
}
