<?php
require_once __DIR__ . '/../model/User.php';
session_start();

class AuthController {
    public function login($email, $password) {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: ../view/home.php');
            exit;
        } else {
            $error = "Identifiants invalides.";
            include '../view/login.php';
        }
    }

    public function register($data) {
        if (User::findByEmail($data['email'])) {
            $error = "Email déjà utilisé.";
            include '../view/register.php';
        } else {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
            // Appel mis à jour avec les bons paramètres
            User::create(
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $hashedPassword,
                $data['id_categorie'],
                $data['id_droit']
            );
    
            header('Location: ../view/login.php');
            exit;
        }
    }
}
?>


