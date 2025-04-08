<?php

require_once "../Classes/ConnectionDB.php";
require_once "../Classes/UserClass.php";
require_once "../Classes/StudentClass.php";
require_once "../Classes/SectionClass.php";

$usr1 = new User(1, "john.doe", "aze123", "john.doe@fake.com", "Student");
$stud1 = new Student(1, "john doe", "2000-02-05", 1, "./path");

$usr2 = new User(2, "jane.smith", "qwe456", "jane.smith@fake.com", "Admin");

$usr3 = new User(3, "michael.brown", "zxc789", "michael.brown@fake.com", "Student");
$stud3 = new Student(3, "michael brown", "1999-01-01", 2, "./path");

$usr5 = new User(4, "david.wilson", "fgh654", "david.wilson@fake.com", "Student");
$stud5 = new Student(4, "david wilson", '2002-08-08', 1, "./path");

$gl = new Sections("GL", "Genie Logiciel");
$rt = new Sections("RT", "Resaux");

$secs = [$gl, $rt];
$usrs = [$usr1, $usr2, $usr3, $usr5];
$studs = [$stud1, $stud3, $stud5];

foreach($secs as $sec) {
    Sections::insertIntoDB($sec);  
}
foreach($usrs as $usr) {
    User::insertUserIntoDB($usr);  
}

foreach($studs as $stud){
    Student::insertIntoDB($stud);
}

?>