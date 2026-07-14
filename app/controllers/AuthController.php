<?php

require_once BASE_PATH . 'app/models/UserModel.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {

                $error = "Email dan Password wajib diisi.";

            } else {

                $user = $this->userModel->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {

                    $_SESSION['user'] = [
                        'id'    => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role'  => $user['role']
                    ];

                    header("Location: " . BASE_URL . "dashboard");
                    exit;

                } else {

                    $error = "Email atau Password salah.";

                }
            }
        }

        $this->view('auth/login', [
            'error' => $error
        ]);
    }

    public function register()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nama = trim($_POST['nama']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm = trim($_POST['confirm_password']);

            if (empty($nama) || empty($email) || empty($password) || empty($confirm)) {

                $error = "Semua field wajib diisi.";

            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $error = "Format email tidak valid.";

            } elseif ($password != $confirm) {

                $error = "Konfirmasi password tidak cocok.";

            } elseif (strlen($password) < 6) {

                $error = "Password minimal 6 karakter.";

            } else {

                $cek = $this->userModel->getUserByEmail($email);

                if ($cek) {

                    $error = "Email sudah digunakan.";

                } else {

                    if ($this->userModel->register($nama, $email, $password)) {

                        $success = "Registrasi berhasil. Silakan login.";

                    } else {

                        $error = "Registrasi gagal.";

                    }

                }

            }

        }

        $this->view('auth/register', [
            'error' => $error,
            'success' => $success
        ]);
    }

    public function logout()
    {
        session_destroy();

        header("Location: " . BASE_URL . "login");
        exit;
    }
}