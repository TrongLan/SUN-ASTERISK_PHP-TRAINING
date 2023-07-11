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
            $userModel->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
            $userInfoSaved = $userModel->saveUserInfo();
            if ($userInfoSaved) {
                header("Location: /login");
            }
        }
    }
}
