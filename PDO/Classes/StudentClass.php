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
    public static $pdo;

    public function getId(){
        return $this->id;
    }

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->query("
                CREATE TABLE IF NOT EXISTS Student (
                    id INT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    birthdate DATE NOT NULL,
                    section INT NOT NULL,
                    imgUrl VARCHAR(255),
                    FOREIGN KEY (id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (section) REFERENCES sections(id) ON DELETE CASCADE ON UPDATE CASCADE
                )
            ");
        }
    }

    public function __construct($id, $name, $birthdate, $section, $imgUrl, $username=null, $email=null, $password=null) {
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
        try {
            $stmt = self::$pdo->prepare("
                INSERT INTO Student (id, name, birthdate, section, imgUrl)
                VALUES (:id, :name, :birthdate, :section, :imgUrl)
            ");
            $stmt->execute([
                ':id' => $s->id,
                ':name' => $s->name,
                ':birthdate' => $s->birthdate,
                ':section' => $s->section,
                ':imgUrl' => $s->imgUrl
            ]);
            if (self::$debugMode) {
                $log = "[INFO]: Student \"$s->name\" added successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } catch (PDOException $e) {
            if (self::$debugMode) {
                $log = "[ERROR]: Failed to add student \"$s->name\". Error: " . $e->getMessage() . "\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }

    public static function removeFromDB($id) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("DELETE FROM Student WHERE id = :id");
        $stmt->execute([':id' => $id]);
        if ($stmt->rowCount() > 0) {
            if (self::$debugMode) {
                $log = "[INFO]: Student \"$id\" removed successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } else {
            if (self::$debugMode) {
                $log = "[WARNING]: Student \"$id\" not found. No record removed.\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }

    public static function fetchAll(){
        self::getDBInstance();
        $stmt = self::$pdo->query(
            "
            SELECT U.id, U.username, Stud.name, U.email, Stud.birthdate, S.designation, U.role
            FROM student Stud, user U, sections S 
            WHERE( (U.role='Student') 
                AND (Stud.section = S.id) 
                AND (Stud.id=U.id))
            "
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id){
        self::getDBInstance();
        $stmt = self::$pdo->prepare(
            "
            SELECT U.id, U.username, Stud.name, U.email, Stud.birthdate, S.id AS sec, S.designation, U.role, Stud.imgUrl
            FROM student Stud, user U, sections S 
            WHERE( 
                U.id = :id
                AND (U.role='Student') 
                AND (Stud.section = S.id) 
                AND (Stud.id=U.id))
            "
        );
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>