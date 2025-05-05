<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../controller/AuthController.php';
session_start();
$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    if ($action === 'login') {
        $controller->login($_POST['email'], $_POST['password']);
    } elseif ($action === 'register') {
        $controller->register($_POST);
    }
} elseif ($_GET['action'] ?? '' === 'logout') {
    session_destroy();
    header('Location: ../view/login.php');
    exit;
} else {
    header('Location: ../view/login.php');
    exit;
}
?>