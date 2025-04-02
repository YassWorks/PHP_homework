<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1 id="header">Students Management System</h1>

    <!-- navbar -->
    <nav id="navbar">
        <ul id="navbar-list">
            <li><a href="home.php">Home</a></li>
            <li><a href="StudentsList.php">Liste des Etudiants</a></li>
            <li><a href="SectionsList.php">Liste des Sections</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

</body>
</html>
<?php

require_once "ConnectionDB.php";
require_once "StudentClass.php";

// $pdo = ConnectionDB::getInstance();

?>