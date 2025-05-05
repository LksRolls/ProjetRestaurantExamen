<?php
if (!isset($_SESSION['darkmode'])) {
    $_SESSION['darkmode'] = false; // par défaut
}
$dark = $_SESSION['darkmode'];
?>
<nav class="navbar navbar-expand-lg <?= $dark ? 'navbar-dark bg-dark' : 'navbar-light bg-light' ?> px-4">
    <a class="navbar-brand" href="home.php">Restaurant</a>
    <div class="ms-auto d-flex gap-2">
        <form method="POST" action="/restaurant/view/toggleDarkmode.php">
            <button type="submit" class="btn btn-outline-<?= $dark ? 'light' : 'dark' ?>">
                <?= $dark ? '☀️ Mode clair' : '🌙 Mode sombre' ?>
            </button>
        </form>
        <a href="admin.php" class="btn btn-outline-primary">Administration</a>
        <a href="profil.php" class="btn btn-outline-primary">Profil</a>
        <a href="../public/index.php?action=logout" class="btn btn-outline-danger">Déconnexion</a>
    </div>
</nav>
