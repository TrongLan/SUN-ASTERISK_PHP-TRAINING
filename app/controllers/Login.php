<?php

class Login extends Controller
{
    private $errorMessage;

    public function index()
    {
        $userModel = $this->loadModel("User");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userModel->setEmail($_POST["email"]);
            $userModel->setPassword($_POST["password"]);

            if ($userModel->existsByEmail()) {
                $byEmail = $userModel->findByEmail();
                if (password_verify($userModel->getPassword(), $byEmail->getPassword())) {
                    header("Location: /home");
                    unset($this->errorMessage);
                } else {
                    $this->errorMessage = "Invalid username or password.";
                }
            } else {
                $this->errorMessage = "Email not found.";
            }
        }
        $this->loadView("login_page", ["errorMessage" => $this->errorMessage]);
    }
}
