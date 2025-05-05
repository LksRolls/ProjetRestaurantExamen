<?php
require_once '../model/Database.php';

// Récupération des catégories et droits
$pdo = Database::connect();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$droits = $pdo->query("SELECT * FROM droits")->fetchAll(PDO::FETCH_ASSOC);

include 'templates/header.php';
?>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4">Créer un compte</h2>
        <form method="POST" action="../public/index.php?action=register">
            <div class="mb-3">
                <input class="form-control" type="text" name="nom" placeholder="Nom" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="mb-3">
                <label>Catégorie</label>
                <select class="form-select" name="id_categorie" required>
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= htmlspecialchars($categorie['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Droit</label>
                <select class="form-select" name="id_droit" required>
                    <option value="">Sélectionner un droit</option>
                    <?php foreach ($droits as $droit): ?>
                        <option value="<?= $droit['id'] ?>"><?= htmlspecialchars($droit['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <button class="btn btn-success w-100">Créer un compte</button>
            <a href="login.php" class="btn btn-link w-100 text-center">Se connecter</a>
        </form>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
