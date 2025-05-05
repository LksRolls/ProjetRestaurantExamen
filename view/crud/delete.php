<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['id_droit'] != 2) exit('Accès refusé');

require_once '../../model/Database.php';
$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? 0;
$pdo = Database::connect();

$stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = ?");
$stmt->execute([$id]);
header("Location: /restaurant/view/admin.php");
exit;
?>