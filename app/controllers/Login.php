<?php

class Login extends Controller
{
    private $errorMessage;

    public function index()
    {
        if (!$this->isNotLoggedIn()) {
            header("Location: /product");
            exit();
        }
        $userModel = $this->loadModel("User");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($userModel->existsByEmail($_POST["email"])) {
                $byEmail = $userModel->findByEmail($_POST["email"]);
                if (password_verify($_POST["password"], $byEmail->getPassword())) {
                    $_SESSION["user_id"] = $byEmail->getId();
                    if ($_POST['rememberMe']) {
                        $cookieExpiration = time() + (2 * 60);
                        setcookie('remember_me', $byEmail->getId(), $cookieExpiration, '/');
                    }
                    header("Location: /product");
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
