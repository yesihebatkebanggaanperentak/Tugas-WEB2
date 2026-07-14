<?php

require_once BASE_PATH . 'app/models/UserModel.php';
require_once BASE_PATH . 'app/models/ProductModel.php';
require_once BASE_PATH . 'app/models/RequestModel.php';

class UserController extends Controller
{
    private $userModel;
    private $productModel;
    private $requestModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->requestModel = new RequestModel();
    }

    public function dashboard()
    {
        $userId = $_SESSION['user']['id'];
        $userData = $this->userModel->getUserById($userId);
        $products = $this->productModel->getAllProducts();
        $requests = $this->requestModel->getRequestsByUserId($userId);

        $this->view('dashboard/user', [
            'user' => $userData,
            'products' => $products,
            'requests' => $requests
        ]);
    }

    public function createRequest($productId)
    {
        if (empty($productId)) {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $userData = $this->userModel->getUserById($userId);

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $quantity = trim($_POST['quantity']);
                $purpose = trim($_POST['purpose']);

                // Validasi Alamat
                if (empty($userData['address_street']) || empty($userData['address_city'])) {
                    $error = 'Alamat Anda belum lengkap. Silakan lengkapi profil terlebih dahulu.';
                } elseif (empty($quantity) || empty($purpose)) {
                    $error = 'Jumlah dan Tujuan Permintaan wajib diisi.';
                } elseif (!is_numeric($quantity) || intval($quantity) <= 0) {
                    $error = 'Jumlah barang harus berupa angka positif.';
                } elseif (intval($quantity) > $product['stock']) {
                    $error = 'Jumlah permintaan melebihi stok yang tersedia (' . $product['stock'] . ').';
                } else {
                    $created = $this->requestModel->createRequest($userId, $productId, intval($quantity), $purpose);
                    if ($created) {
                        $_SESSION['flash_success'] = 'Permintaan barang berhasil diajukan!';
                        header('Location: ' . BASE_URL . 'dashboard');
                        exit;
                    } else {
                        $error = 'Gagal mengajukan permintaan.';
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        $this->view('requests/create', [
            'product' => $product,
            'user' => $userData,
            'error' => $error
        ]);
    }

    public function profile()
    {
        $id = $_SESSION['user']['id'];
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $street = trim($_POST['address_street']);
                $city = trim($_POST['address_city']);
                $province = trim($_POST['address_province']);
                $zip = trim($_POST['address_zip']);

                if (empty($username) || empty($email)) {
                    $error = 'Nama dan Email wajib diisi.';
                } else {
                    // Check if email taken by someone else
                    $existing = $this->userModel->getUserByEmail($email);
                    if ($existing && $existing['id'] != $id) {
                        $error = 'Email sudah digunakan oleh user lain.';
                    } else {
                        $updated = $this->userModel->updateProfile($id, $username, $email, $street, $city, $province, $zip);
                        if ($updated) {
                            $success = 'Profil dan alamat berhasil diperbarui!';
                            // Update session info
                            $_SESSION['user']['username'] = $username;
                            $_SESSION['user']['email'] = $email;
                        } else {
                            $error = 'Gagal memperbarui profil.';
                        }
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        $userData = $this->userModel->getUserById($id);
        $this->view('users/profile', [
            'user' => $userData,
            'error' => $error,
            'success' => $success
        ]);
    }
}
