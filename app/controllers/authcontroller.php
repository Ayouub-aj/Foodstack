<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class authcontroller {
    private $userModel;

    public function __construct() {
        require_once dirname(__DIR__) . '/models/user.php';
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if ($this->userModel->createUser($username, $email, $hashedPassword)) {
                header('Location: login.php?success=account_created');
                exit();
            } else {
                echo "Error during registration.";
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../recipes/index.php');
                exit();
            } else {
                header('Location: login.php?error=invalid_credentials');
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../auth/login.php');
        exit();
    }
}