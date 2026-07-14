<?php

require_once BASE_PATH . 'app/models/UserModel.php';
require_once BASE_PATH . 'app/models/CategoryModel.php';
require_once BASE_PATH . 'app/models/ProductModel.php';
require_once BASE_PATH . 'app/models/RequestModel.php';

class AdminController extends Controller
{
    private $userModel;
    private $categoryModel;
    private $productModel;
    private $requestModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Ensure user is admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
        $this->requestModel = new RequestModel();
    }

    public function dashboard()
    {
        $users = $this->userModel->getAllUsers();
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        $requests = $this->requestModel->getAllRequests();
        
        $pendingCount = 0;
        foreach ($requests as $r) {
            if ($r['status'] === 'pending') {
                $pendingCount++;
            }
        }
        
        $this->view('dashboard/admin', [
            'usersCount' => count($users),
            'productsCount' => count($products),
            'categoriesCount' => count($categories),
            'pendingCount' => $pendingCount
        ]);
    }

    // --- USERS ---
    public function index()
    {
        $users = $this->userModel->getAllUsers();
        $this->view('users/index', ['users' => $users]);
    }

    public function create()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $role = trim($_POST['role']);
                $street = trim($_POST['address_street']);
                $city = trim($_POST['address_city']);
                $province = trim($_POST['address_province']);
                $zip = trim($_POST['address_zip']);

                if (empty($username) || empty($email) || empty($password) || empty($role)) {
                    $error = 'Nama, Email, Password, dan Role wajib diisi.';
                } else {
                    $existing = $this->userModel->getUserByEmail($email);
                    if ($existing) {
                        $error = 'Email sudah terdaftar.';
                    } else {
                        $created = $this->userModel->createUser($username, $email, $password, $role, $street, $city, $province, $zip);
                        if ($created) {
                            $_SESSION['flash_success'] = 'User baru berhasil ditambahkan!';
                            header('Location: ' . BASE_URL . 'admin/users');
                            exit;
                        } else {
                            $error = 'Gagal menambahkan user.';
                        }
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        $this->view('users/create', ['error' => $error]);
    }

    public function edit($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $_SESSION['flash_error'] = 'User tidak ditemukan.';
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $role = trim($_POST['role']);
                $street = trim($_POST['address_street']);
                $city = trim($_POST['address_city']);
                $province = trim($_POST['address_province']);
                $zip = trim($_POST['address_zip']);

                if (empty($username) || empty($email) || empty($role)) {
                    $error = 'Nama, Email, dan Role wajib diisi.';
                } else {
                    $existing = $this->userModel->getUserByEmail($email);
                    if ($existing && $existing['id'] != $id) {
                        $error = 'Email sudah digunakan oleh user lain.';
                    } else {
                        $updated = $this->userModel->updateUser($id, $username, $email, $role, $street, $city, $province, $zip, $password);
                        if ($updated) {
                            $_SESSION['flash_success'] = 'Data user berhasil diperbarui!';
                            header('Location: ' . BASE_URL . 'admin/users');
                            exit;
                        } else {
                            $error = 'Gagal memperbarui user.';
                        }
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        $this->view('users/edit', ['user' => $user, 'error' => $error]);
    }

    public function delete($id)
    {
        if (!empty($id)) {
            try {
                if ($id == $_SESSION['user']['id']) {
                    $_SESSION['flash_error'] = 'Anda tidak dapat menghapus akun Anda sendiri.';
                } else {
                    $deleted = $this->userModel->deleteUser($id);
                    if ($deleted) {
                        $_SESSION['flash_success'] = 'User berhasil dihapus.';
                    } else {
                        $_SESSION['flash_error'] = 'Gagal menghapus user.';
                    }
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menghapus user: ' . $e->getMessage();
            }
        }
        header('Location: ' . BASE_URL . 'admin/users');
        exit;
    }

    // --- CATEGORIES ---
    public function indexCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->view('categories/index', ['categories' => $categories]);
    }

    public function createCategory()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);

                if (empty($name)) {
                    $error = 'Nama kategori wajib diisi.';
                } else {
                    $this->categoryModel->createCategory($name, $description);
                    $_SESSION['flash_success'] = 'Kategori baru berhasil ditambahkan!';
                    header('Location: ' . BASE_URL . 'admin/categories');
                    exit;
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }
        $this->view('categories/create', ['error' => $error]);
    }

    public function editCategory($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . 'admin/categories');
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['flash_error'] = 'Kategori tidak ditemukan.';
            header('Location: ' . BASE_URL . 'admin/categories');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);

                if (empty($name)) {
                    $error = 'Nama kategori wajib diisi.';
                } else {
                    $this->categoryModel->updateCategory($id, $name, $description);
                    $_SESSION['flash_success'] = 'Kategori berhasil diperbarui!';
                    header('Location: ' . BASE_URL . 'admin/categories');
                    exit;
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }
        $this->view('categories/edit', ['category' => $category, 'error' => $error]);
    }

    public function deleteCategory($id)
    {
        if (!empty($id)) {
            try {
                $this->categoryModel->deleteCategory($id);
                $_SESSION['flash_success'] = 'Kategori berhasil dihapus.';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menghapus kategori: ' . $e->getMessage();
            }
        }
        header('Location: ' . BASE_URL . 'admin/categories');
        exit;
    }

    // --- PRODUCTS ---
    public function indexProducts()
    {
        $products = $this->productModel->getAllProducts();
        $this->view('products/index', ['products' => $products]);
    }

    public function createProduct()
    {
        $error = '';
        $categories = $this->categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = trim($_POST['name']);
                $categoryId = trim($_POST['category_id']);
                $description = trim($_POST['description']);
                $stock = trim($_POST['stock']);

                if (empty($name) || empty($categoryId) || $stock === '') {
                    $error = 'Nama, Kategori, dan Stok wajib diisi.';
                } elseif (!is_numeric($stock) || intval($stock) < 0) {
                    $error = 'Stok harus berupa angka positif.';
                } else {
                    $imagePath = '';
                    // Handle file upload
                    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                        $file = $_FILES['image'];
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
                        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                        if (!in_array($fileExtension, $allowedExtensions)) {
                            $error = 'Format file tidak diizinkan. Hanya gambar (JPG, JPEG, PNG, GIF) atau PDF.';
                        } elseif ($file['size'] > 2 * 1024 * 1024) {
                            $error = 'Ukuran file maksimal adalah 2MB.';
                        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
                            $error = 'Gagal mengupload file.';
                        } else {
                            // Ensure upload directory exists
                            $uploadDir = BASE_PATH . 'public/uploads/';
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }
                            $fileName = uniqid('prod_', true) . '.' . $fileExtension;
                            if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                                $imagePath = $fileName;
                            } else {
                                $error = 'Gagal menyimpan file di server.';
                            }
                        }
                    }

                    if (empty($error)) {
                        $this->productModel->createProduct($categoryId, $name, $description, $imagePath, intval($stock));
                        $_SESSION['flash_success'] = 'Produk baru berhasil ditambahkan!';
                        header('Location: ' . BASE_URL . 'admin/products');
                        exit;
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }
        $this->view('products/create', ['categories' => $categories, 'error' => $error]);
    }

    public function editProduct($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . 'admin/products');
            exit;
        }
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
            header('Location: ' . BASE_URL . 'admin/products');
            exit;
        }

        $error = '';
        $categories = $this->categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = trim($_POST['name']);
                $categoryId = trim($_POST['category_id']);
                $description = trim($_POST['description']);
                $stock = trim($_POST['stock']);

                if (empty($name) || empty($categoryId) || $stock === '') {
                    $error = 'Nama, Kategori, dan Stok wajib diisi.';
                } elseif (!is_numeric($stock) || intval($stock) < 0) {
                    $error = 'Stok harus berupa angka positif.';
                } else {
                    $imagePath = $product['image']; // Default to old image
                    // Handle file upload
                    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                        $file = $_FILES['image'];
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
                        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                        if (!in_array($fileExtension, $allowedExtensions)) {
                            $error = 'Format file tidak diizinkan. Hanya gambar (JPG, JPEG, PNG, GIF) atau PDF.';
                        } elseif ($file['size'] > 2 * 1024 * 1024) {
                            $error = 'Ukuran file maksimal adalah 2MB.';
                        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
                            $error = 'Gagal mengupload file.';
                        } else {
                            // Ensure upload directory exists
                            $uploadDir = BASE_PATH . 'public/uploads/';
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }
                            $fileName = uniqid('prod_', true) . '.' . $fileExtension;
                            if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                                // Delete old file if exists
                                if (!empty($product['image']) && file_exists($uploadDir . $product['image'])) {
                                    unlink($uploadDir . $product['image']);
                                }
                                $imagePath = $fileName;
                            } else {
                                $error = 'Gagal menyimpan file baru di server.';
                            }
                        }
                    }

                    if (empty($error)) {
                        $this->productModel->updateProduct($id, $categoryId, $name, $description, $imagePath, intval($stock));
                        $_SESSION['flash_success'] = 'Produk berhasil diperbarui!';
                        header('Location: ' . BASE_URL . 'admin/products');
                        exit;
                    }
                }
            } catch (Exception $e) {
                $error = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }
        $this->view('products/edit', ['product' => $product, 'categories' => $categories, 'error' => $error]);
    }

    public function deleteProduct($id)
    {
        if (!empty($id)) {
            try {
                $product = $this->productModel->getProductById($id);
                if ($product) {
                    // Delete image file from server
                    if (!empty($product['image'])) {
                        $filePath = BASE_PATH . 'public/uploads/' . $product['image'];
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                    $this->productModel->deleteProduct($id);
                    $_SESSION['flash_success'] = 'Produk berhasil dihapus.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menghapus produk: ' . $e->getMessage();
            }
        }
        header('Location: ' . BASE_URL . 'admin/products');
        exit;
    }

    // --- REQUESTS ---
    public function indexRequests()
    {
        $requests = $this->requestModel->getAllRequests();
        $this->view('requests/index', ['requests' => $requests]);
    }

    public function approveRequest($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . 'admin/requests');
            exit;
        }

        try {
            $request = $this->requestModel->getRequestById($id);
            if (!$request) {
                $_SESSION['flash_error'] = 'Permintaan tidak ditemukan.';
            } elseif ($request['status'] !== 'pending') {
                $_SESSION['flash_error'] = 'Permintaan sudah diproses sebelumnya.';
            } else {
                // Check stock sufficiency
                if ($request['product_stock'] < $request['quantity']) {
                    $_SESSION['flash_error'] = 'Stok barang tidak mencukupi untuk disetujui.';
                } else {
                    // Deduct stock and update status
                    $newStock = $request['product_stock'] - $request['quantity'];
                    $this->productModel->updateStock($request['product_id'], $newStock);
                    $this->requestModel->updateStatus($id, 'approved');
                    $_SESSION['flash_success'] = 'Permintaan barang berhasil disetujui!';
                }
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'Gagal memproses persetujuan: ' . $e->getMessage();
        }

        header('Location: ' . BASE_URL . 'admin/requests');
        exit;
    }

    public function rejectRequest($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . 'admin/requests');
            exit;
        }

        try {
            $request = $this->requestModel->getRequestById($id);
            if (!$request) {
                $_SESSION['flash_error'] = 'Permintaan tidak ditemukan.';
            } elseif ($request['status'] !== 'pending') {
                $_SESSION['flash_error'] = 'Permintaan sudah diproses sebelumnya.';
            } else {
                $this->requestModel->updateStatus($id, 'rejected');
                $_SESSION['flash_success'] = 'Permintaan barang telah ditolak.';
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'Gagal memproses penolakan: ' . $e->getMessage();
        }

        header('Location: ' . BASE_URL . 'admin/requests');
        exit;
    }
}
