<?php

require_once "UserClass.php";
require_once "ConnectionDB.php";

class Admin extends User {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    // public $db_name = "Admin";
    public $id;
    public $name;
    private static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS Admin (
                    id INT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    role VARCHAR(50) NOT NULL
                )
            ");
        }
    }

    public function __construct($name, $id, $password, $username=null, $email=null) {
        $name = preg_replace('/\s+/', ' ', trim($name));
        if (!isset($username)) $username = str_replace(' ', '.', $name);
        if (!isset($email)) $email = strtolower($username) . "@institute.com";
        parent::__construct($id, $username, $password, $email, "Admin");
        $this->id = $id;
        $this->name = $name;
    }

    public static function insertIntoDB(Admin $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("
            INSERT INTO Admin (id, name, password, email, role)
            VALUES (:id, :name, :password, :email, :role)
        ");
        $stmt->execute([
            ':id' => $s->id,
            ':name' => $s->name,
            ':password' => $s->password,
            ':email' => $s->email,
            ':role' => $s->role
        ]);
        if (self::$debugMode) {
            $log = "[INFO]: Admin \"$s->name\" added successfully\n";
            file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
        }
    }

    public static function removeFromDB(Admin $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("
            DELETE FROM Admin
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $s->id
        ]);
        if (self::$debugMode) {
            $log = "[INFO]: Admin \"$s->name\" removed successfully\n";
            file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
        }
    }
}

?>