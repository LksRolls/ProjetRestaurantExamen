<?php
require_once 'Database.php';

class User {
    public static function findByEmail($email) {
        $stmt = Database::connect()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($nom, $prenom, $email, $password, $id_categorie, $id_droit) {
        $stmt = Database::connect()->prepare("
            INSERT INTO users (nom, prenom, email, password, date_creation, id_categorie, id_droit)
            VALUES (?, ?, ?, ?, NOW(), ?, ?)
        ");
        $stmt->execute([$nom, $prenom, $email, $password, $id_categorie, $id_droit]);
    }
}
?>
