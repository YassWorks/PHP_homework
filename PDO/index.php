<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management System</title>
    <link rel="stylesheet" href="/style.css"> 
</head>
<body>
    
    <h1 id="header">Students Management System</h1>
    
    <?php

    require_once "/Classes/ConnectionDB.php";

    

    ?>

    <div class="form">
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>