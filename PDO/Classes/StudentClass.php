<?php

require_once "UserClass.php";
require_once "ConnectionDB.php";

class Student extends User {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    // public $db_name = "Student";
    public $id;
    public $name;
    public $birthdate;
    public $section;
    public $imgUrl;
    private static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->query("
                CREATE TABLE IF NOT EXISTS Student (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    username VARCHAR(100) UNIQUE NOT NULL,
                    birthdate DATE NOT NULL,
                    section VARCHAR(100) NOT NULL,
                    imgUrl VARCHAR(255),
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    role VARCHAR(50) NOT NULL
                )
            ");
        }
    }

    public function __construct($id, $name, $password, $birthdate, $section, $imgUrl, $username=null, $email=null) {
        $name = preg_replace('/\s+/', ' ', trim($name));
        if (!isset($username)) $username = str_replace(' ', '.', $name);
        if (!isset($email)) $email = strtolower($username) . "@institute.com";
        parent::__construct($id, $username, $password, $email, "Student");
        $this->id = $id;
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->section = $section;
        $this->imgUrl = $imgUrl;
    }

    public static function insertIntoDB(Student $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("
            INSERT INTO Student (name, username, birthdate, section, imgUrl, email, password, role)
            VALUES (:name, :username, :birthdate, :section, :imgUrl, :email, :password, :role)
        ");
        $stmt->execute([
            ':name' => $s->name,
            ':username' => $s->username,
            ':birthdate' => $s->birthdate,
            ':section' => $s->section,
            ':imgUrl' => $s->imgUrl,
            ':email' => $s->email,
            ':password' => $s->password,
            ':role' => $s->role
        ]);
        if (self::$debugMode) {
            $log = "[INFO]: Student \"$s->name\" added successfully\n";
            file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
        }
    }

    public static function removeFromDB(Student $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("DELETE FROM Student WHERE id = :id");
        $stmt->execute([':id' => $s->id]);
        if (self::$debugMode) {
            $log = "[INFO]: Student \"$s->name\" removed successfully\n";
            file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
        }
    }
}

?>