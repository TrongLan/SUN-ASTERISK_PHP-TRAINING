<?php
require_once "./vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class Register extends Controller
{
    private $errors = [];

    public function index()
    {
        $userModel = $this->loadModel("User");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $requiredErrors = CustomValidator::commonValidate([
                "email" => $_POST["email"],
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "first-name" => $_POST["first-name"],
                "last-name" => $_POST["last-name"]]);
            $lengthErrors = CustomValidator::lengthValidation([
                "email" => [$_POST["email"], 255],
                "username" => [$_POST["username"], 50],
                "first-name" => [$_POST["first-name"], 50],
                "last-name" => [$_POST["last-name"], 50]
            ]);
            $this->errors = array_merge($requiredErrors, $lengthErrors);

            if ($userModel->existsByUsername($_POST["username"])) {
                $this->errors["username"] = "username has already been taken.";
            }
            if ($userModel->existsByEmail($_POST["email"])) {
                $this->errors["email"] = "mail has already existed.";
            }
            if (empty($this->errors)) {
                $userModel->setId(Uuid::uuid4()->toString());
                $userModel->setEmail($_POST["email"]);
                $userModel->setFirstName($_POST["first-name"]);
                $userModel->setLastName($_POST["last-name"]);
                $userModel->setUsername($_POST["username"]);
                $userModel->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
                $userInfoSaved = $userModel->saveUserInfo();
                if ($userInfoSaved) {
                    header("Location: /login");
                    exit();
                }
            }
        }
        $this->loadView("register_page", ["errors" => $this->errors]);
        unset($this->errors);
    }
}
