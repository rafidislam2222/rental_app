<?php
require_once "../core/Controller.php";

class UserController extends Controller {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $role = trim($_POST['role']);

            $userModel = $this->model("User");

            // Check if email already exists
            if ($userModel->findByEmail($email)) {
                $error = "Email already exists!";
                $this->view("users/register", ['error' => $error]);
                return;
            }

            // Register user
            if ($userModel->register($name, $email, $password, $role)) {
                // Redirect to login page after successful registration
                header("Location: /rental_system/public/index.php?url=UserController/login");
                exit;
            } else {
                $error = "Registration failed!";
                $this->view("users/register", ['error' => $error]);
            }
        } else {
            $this->view("users/register");
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $userModel = $this->model("User");
            $user = $userModel->login($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'owner') {
                    header("Location: /rental_system/public/index.php?url=OwnerController/dashboard");
                } else {
                    header("Location: /rental_system/public/index.php?url=RenterController/dashboard");
                }
                exit;
            } else {
                $error = "Invalid email or password!";
                $this->view("users/login", ['error' => $error]);
            }
        } else {
            $this->view("users/login");
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /rental_system/public/index.php?url=UserController/login");
        exit;
    }
}
?>
