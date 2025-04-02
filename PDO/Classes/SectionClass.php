<?php

require_once "ConnectionDB.php";

class Section {
    public static $debugMode = true;
    private const LOG_FILE = '../session_logs.log';
    // public $db_name = "Section";
    public $id;
    public $designation;
    public $description;
    private static $pdo;

    private static function getDBInstance() {
        if (self::$pdo === null) {
            self::$pdo = ConnectionDB::getInstance();
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS sections (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    designation VARCHAR(255) NOT NULL,
                    description TEXT
                )
            ");
        }
    }

    public function __construct($id, $designation, $description) {
        $this->id = $id;
        $this->designation = $designation;
        $this->description = $description;
    }

    public static function insertIntoDB(Section $s) {
        self::getDBInstance();
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
    }

    public static function removeFromDB(Section $s) {
        self::getDBInstance();
        $stmt = self::$pdo->prepare("
            DELETE FROM sections
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $s->id
        ]);
        if (self::$debugMode) {
            $log = "[INFO]: Section \"$s->designation\" removed successfully\n";
            file_put_contents(self::LOG_FILE, $log, FILE_APPEND);
        }
    }
}

?>