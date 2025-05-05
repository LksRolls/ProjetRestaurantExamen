<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['id_droit'] != 2) {
    exit('Accès refusé');
}

require_once '../model/Database.php';
include 'templates/headerAdmin.php';

$pdo = Database::connect();
$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

echo '<h2 class="text-center my-4">Panneau d\'administration</h2>';

foreach ($tables as $table) {
    echo '<div class="container mb-5">';
    echo "<h3 class='mb-3 text-center text-capitalize'>" . htmlspecialchars($table) . "</h3>";
    echo "<div class='text-center mb-3'><a href='crud/add.php?table=$table' class='btn btn-success'>Ajouter</a></div>";

    // Requête spéciale pour users (on masque les mots de passe)
    if ($table === 'users') {
        $rows = $pdo->query("SELECT id, nom, prenom, email, '•••••' AS password, date_creation, id_droit, id_categorie FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    }

    if (count($rows) > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead class='table-dark'><tr>";
        foreach (array_keys($rows[0]) as $col) {
            echo "<th>" . htmlspecialchars($col) . "</th>";
        }
        echo "<th>Modifier</th><th>Supprimer</th>";
        echo "</tr></thead><tbody>";

        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "<td><a href='crud/edit.php?table=$table&id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Modifier</a></td>";
            echo "<td><a href='crud/delete.php?table=$table&id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='text-center'>Aucune donnée trouvée.</p>";
    }

    echo '</div>';
}

include 'templates/footer.php';
?>
