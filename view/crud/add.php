<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['id_droit'] != 2) exit('Accès refusé');

require_once '../../model/Database.php';
$table = $_GET['table'] ?? '';
$pdo = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = array_keys($_POST);
    $placeholders = implode(', ', array_fill(0, count($fields), '?'));
    $columns = implode(', ', $fields);
    $stmt = $pdo->prepare("INSERT INTO `$table` ($columns) VALUES ($placeholders)");
    $stmt->execute(array_values($_POST));
    header("Location: ../admin.php");
    exit;
}

$columns = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_COLUMN);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<a href="../admin.php" class="btn btn-secondary position-absolute m-3" style="top: 0; left: 0;">&larr; Retour</a>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 600px;">
        <h2 class="text-center mb-4">Ajouter dans <?= htmlspecialchars($table) ?></h2>
        <form method="POST">
            <?php foreach ($columns as $column): ?>
                <?php if ($column !== 'id'): ?>
                    <div class="mb-3">
                        <label class="form-label"><?= htmlspecialchars($column) ?></label>
                        <input class="form-control" name="<?= htmlspecialchars($column) ?>" required>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success w-100">Ajouter</button>
        </form>
    </div>
</div>
