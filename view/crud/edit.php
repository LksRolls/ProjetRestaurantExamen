<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['id_droit'] != 2) exit('Accès refusé');

require_once '../../model/Database.php';
$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? 0;
$pdo = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = array_keys($_POST);
    $setClause = implode(', ', array_map(function($f) { return "$f = ?"; }, $fields));
    $stmt = $pdo->prepare("UPDATE `$table` SET $setClause WHERE id = ?");
    $stmt->execute([...array_values($_POST), $id]);
    header("Location: /restaurant/view/admin.php");
    exit;
}

$row = $pdo->prepare("SELECT * FROM `$table` WHERE id = ?");
$row->execute([$id]);
$data = $row->fetch(PDO::FETCH_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 600px;">
        <h2 class="text-center mb-4">Modifier dans <?= htmlspecialchars($table) ?></h2>
        <form method="POST">
            <?php foreach ($data as $column => $value): ?>
                <?php if ($column !== 'id'): ?>
                    <div class="mb-3">
                        <label class="form-label"><?= htmlspecialchars($column) ?></label>
                        <input class="form-control" name="<?= htmlspecialchars($column) ?>" value="<?= htmlspecialchars($value) ?>" required>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
        </form>
    </div>
</div>
