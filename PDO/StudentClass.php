<?php

class Student {
    public int $id;
    public string $name;
    public DateTime $birthdate;

    public function __construct($id, $name, $birthdate) {
        $this->id = $id;
        $this->name = $name;
        $this->birthdate = $birthdate;
    }

    public static function insertIntoDB(Student $s) {

    }

    public static function removeFromDB(Student $s) {

    }

    
}

?>