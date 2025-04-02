<?php

require_once "ConnectionDB.php";
class User {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    // public $db_name = "User";
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $role;
    public static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->query("
                CREATE TABLE IF NOT EXISTS User (
                    id INT PRIMARY KEY,
                    username VARCHAR(25) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    role VARCHAR(50) NOT NULL
                )
            ");
        }
    }

    public function __construct($id, $username, $password, $email, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public static function insertUserIntoDB(User $s) {
        self::getDBInstance();
        try {
            $stmt = self::$pdo->prepare("
                INSERT INTO User (id, username, password, email, role) 
                VALUES (:id, :username, :password, :email, :role)"
            );
            $stmt->execute([
                ':id' => $s->id,
                ':username' => $s->username,
                ':password' => password_hash($s->password, PASSWORD_DEFAULT),
                ':email' => $s->email,
                ':role' => $s->role
            ]);
            if (self::$debugMode) {
                $log = "[INFO]: User \"$s->username\" added successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } catch (PDOException $e) {
            if (self::$debugMode) {
                $log = "[ERROR]: Failed to add user \"$s->username\". Error: " . $e->getMessage() . "\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }

    public static function removeUserFromDB(User $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("DELETE FROM User WHERE id = :id");
        $stmt->execute([':id' => $s->id]);
        if ($stmt->rowCount() > 0) {
            if (self::$debugMode) {
                $log = "[INFO]: User \"$s->username\" removed successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } else {
            if (self::$debugMode) {
                $log = "[WARNING]: User \"$s->username\" not found. No deletion occurred\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }
}

?>