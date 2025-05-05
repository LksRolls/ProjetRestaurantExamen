<?php include 'templates/header.php'; ?>
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4">Connexion</h2>
        <form method="POST" action="../public/index.php?action=login">
            <div class="mb-3">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <button class="btn btn-success w-100">Se connecter</button>
            <a href="register.php" class="btn btn-link w-100 text-center">Créer un compte</a>
        </form>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
