<?php

require_once "UserClass.php";
require_once "ConnectionDB.php";

class Admin extends User {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    // public $db_name = "Admin";
    public $id;
    public $name;
    public static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS Admin (
                    id INT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL
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
        try {
            $stmt = self::$pdo->prepare("
                INSERT INTO Admin (id, name)
                VALUES (:id, :name)
            ");
            $stmt->execute([
                ':id' => $s->id,
                ':name' => $s->name
            ]);
            if (self::$debugMode) {
                $log = "[INFO]: Admin \"$s->name\" added successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } catch (PDOException $e) {
            if (self::$debugMode) {
                $log = "[ERROR]: Failed to add Admin \"$s->name\". Error: " . $e->getMessage() . "\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
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
        if ($stmt->rowCount() > 0) {
            if (self::$debugMode) {
                $log = "[INFO]: Admin \"$s->name\" removed successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } else {
            if (self::$debugMode) {
                $log = "[WARNING]: No Admin found with ID \"$s->id\" to remove\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }
}

?>