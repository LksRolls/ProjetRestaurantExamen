<?php
class Database {
    private static $host = "localhost";
    private static $dbname = "cp2510136p26_restaurant";
    private static $username = "cp2510136p26_Lukas";
    private static $password = "Rolls2313@";
    private static $pdo = null;

    public static function connect() {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4", self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>