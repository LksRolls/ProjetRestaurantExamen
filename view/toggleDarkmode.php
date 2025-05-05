<?php
session_start();
$_SESSION['darkmode'] = !($_SESSION['darkmode'] ?? false);
header('Location: ' . $_SERVER['HTTP_REFERER']); // Retourne à la page précédente
exit;
