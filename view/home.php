<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../model/Database.php';
$prenom = htmlspecialchars($_SESSION['user']['prenom']);
$id_categorie = $_SESSION['user']['id_categorie'];

// Récupération des prestations et prix de l'utilisateur
$pdo = Database::connect();
$stmt = $pdo->prepare("
    SELECT prestations.nom AS prestation, prix.prix
    FROM prestations
    JOIN prix ON prix.id_prestation = prestations.id
    WHERE prix.id_categorie = ?
");
$stmt->execute([$id_categorie]);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SESSION['user']['id_droit'] == 2) {
    include 'templates/headerAdmin.php';
} else {
    include 'templates/headerUser.php';
}

?>

<!-- Partie 1 : Message de bienvenue -->
<div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <h1 class="display-4 text-center">Bienvenue, <?= $prenom ?> 👋</h1>
</div>

<!-- Partie 2 : Tableau des prestations -->
<div class="container mb-5" style="min-height: 50vh;">
    <h2 class="text-center mb-4">Nos services pour votre catégorie</h2>
    <table class="table table-bordered table-striped shadow">
        <thead class="table-dark">
            <tr>
                <th>Prestation</th>
                <th>Prix (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['prestation']) ?></td>
                    <td><?= number_format($service['prix'], 2, ',', ' ') ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'templates/footer.php'; ?>
