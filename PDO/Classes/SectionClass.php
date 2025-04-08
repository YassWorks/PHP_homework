<?php

require_once "ConnectionDB.php";

class Sections {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    public $id;
    public $designation;
    public $description;
    private static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS sections (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    designation VARCHAR(255) NOT NULL UNIQUE,
                    description TEXT
                )
            ");
        }
    }

    public function __construct($designation=null, $description=null) {
        $this->designation = $designation;
        $this->description = $description;
    }

    public static function insertIntoDB(Sections $s) {
        self::getDBInstance();
        try {
            $stmt = self::$pdo->prepare("
                INSERT INTO sections (designation, description)
                VALUES (:designation, :description)");
            $stmt->execute([
                ':designation' => $s->designation,
                ':description' => $s->description
            ]);
            if (self::$debugMode) {
                $log = "[INFO]: Section \"$s->designation\" added successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } catch (PDOException $e) {
            if (self::$debugMode) {
                $log = "[ERROR]: Failed to add section \"$s->designation\". Error: " . $e->getMessage() . "\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }

    public static function removeFromDB(Sections $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("
            DELETE FROM sections
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $s->id
        ]);
        if ($stmt->rowCount() > 0) {
            if (self::$debugMode) {
                $log = "[INFO]: Section \"$s->designation\" removed successfully\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        } else {
            if (self::$debugMode) {
                $log = "[WARNING]: Section \"$s->designation\" does not exist. No deletion performed.\n";
                file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
            }
        }
    }
}

?>