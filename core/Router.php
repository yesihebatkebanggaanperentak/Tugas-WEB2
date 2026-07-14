<?php

class Router
{
    public static function route()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = $_GET['url'] ?? '';
        $url = rtrim($url, '/');

        // Split url by '/' to read parts
        $parts = explode('/', $url);
        $route = $parts[0] ?? '';

        switch ($route) {
            case '':
                require_once BASE_PATH . 'app/controllers/HomeController.php';
                $controller = new HomeController();
                $controller->index();
                break;

            case 'login':
                require_once BASE_PATH . 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->login();
                break;

            case 'register':
                require_once BASE_PATH . 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->register();
                break;

            case 'logout':
                require_once BASE_PATH . 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->logout();
                break;

            case 'profile':
                if (!isset($_SESSION['user'])) {
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }
                require_once BASE_PATH . 'app/controllers/UserController.php';
                $controller = new UserController();
                $controller->profile();
                break;

            case 'admin':
                // Check if admin
                if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }
                
                require_once BASE_PATH . 'app/controllers/AdminController.php';
                $controller = new AdminController();
                
                $subRoute = $parts[1] ?? '';
                if ($subRoute === 'users') {
                    $action = $parts[2] ?? 'index';
                    $id = $parts[3] ?? null;
                    
                    if ($action === 'create') {
                        $controller->create();
                    } elseif ($action === 'edit') {
                        $controller->edit($id);
                    } elseif ($action === 'delete') {
                        $controller->delete($id);
                    } else {
                        $controller->index();
                    }
                } elseif ($subRoute === 'categories') {
                    $action = $parts[2] ?? 'index';
                    $id = $parts[3] ?? null;
                    
                    if ($action === 'create') {
                        $controller->createCategory();
                    } elseif ($action === 'edit') {
                        $controller->editCategory($id);
                    } elseif ($action === 'delete') {
                        $controller->deleteCategory($id);
                    } else {
                        $controller->indexCategories();
                    }
                } elseif ($subRoute === 'products') {
                    $action = $parts[2] ?? 'index';
                    $id = $parts[3] ?? null;
                    
                    if ($action === 'create') {
                        $controller->createProduct();
                    } elseif ($action === 'edit') {
                        $controller->editProduct($id);
                    } elseif ($action === 'delete') {
                        $controller->deleteProduct($id);
                    } else {
                        $controller->indexProducts();
                    }
                } elseif ($subRoute === 'requests') {
                    $action = $parts[2] ?? 'index';
                    $id = $parts[3] ?? null;
                    
                    if ($action === 'approve') {
                        $controller->approveRequest($id);
                    } elseif ($action === 'reject') {
                        $controller->rejectRequest($id);
                    } else {
                        $controller->indexRequests();
                    }
                } else {
                    $controller->dashboard();
                }
                break;

            case 'dashboard':
                if (!isset($_SESSION['user'])) {
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }
                if ($_SESSION['user']['role'] === 'admin') {
                    header('Location: ' . BASE_URL . 'admin');
                } else {
                    require_once BASE_PATH . 'app/controllers/UserController.php';
                    $controller = new UserController();
                    $controller->dashboard();
                }
                break;

            case 'requests':
                if (!isset($_SESSION['user'])) {
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }
                require_once BASE_PATH . 'app/controllers/UserController.php';
                $controller = new UserController();
                
                $action = $parts[1] ?? '';
                if ($action === 'create') {
                    $productId = $parts[2] ?? null;
                    $controller->createRequest($productId);
                } else {
                    header('Location: ' . BASE_URL . 'dashboard');
                }
                break;

            default:
                http_response_code(404);
                require_once BASE_PATH . 'app/controllers/HomeController.php';
                $controller = new HomeController();
                $controller->notFound();
                break;
        }
    }
}