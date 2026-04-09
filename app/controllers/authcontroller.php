<?php
if (session_status() === PHP_SESSION_NONE) session_start();

class authController {
    private $md;
    public function __construct() {
        require_once dirname(__DIR__) . '/models/user.php';
        $this->md = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = htmlspecialchars($_POST['username']);
            $e = htmlspecialchars($_POST['email']);
            $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($this->md->createUser($u, $e, $p)) { header('Location: login.php?success=account_created'); exit(); }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $e = htmlspecialchars($_POST['email']);
            $p = $_POST['password'];
            $u = $this->md->getUserByEmail($e);
            if ($u && password_verify($p, $u['password'])) {
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['username'] = $u['username'];
                header('Location: ../recipes/index.php'); exit();
            }
            header('Location: login.php?error=invalid_credentials'); exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../auth/login.php'); exit();
    }
}
?>