<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../model/Database.php';

$pdo = Database::connect();

// Récupère le nom de la catégorie via jointure
$stmt = $pdo->prepare("
    SELECT users.nom, users.prenom, users.email, categories.nom AS categorie
    FROM users
    JOIN categories ON users.id_categorie = categories.id
    WHERE users.id = ?
");
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['user']['id_droit'] == 2) {
    include 'templates/headerAdmin.php';
} else {
    include 'templates/headerUser.php';
}
?>

<h2 class="text-center mb-4">Mon profil</h2>

<form class="mx-auto" style="max-width: 500px;" id="profilForm">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($user['categorie']) ?>" disabled>
    </div>

</form>
<div class="text-center mt-4">
    <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<?php include 'templates/footer.php'; ?>
