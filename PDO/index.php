<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management System</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    
    <h1 id="header">Students Management System</h1>
    <br>
    <br>
    <br>

    <div>
        <form action="" method="post">
            <label for="usernameEmail">Username/Email:</label>
            <input type="text" id="usernameEmail" name="usernameEmail" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    <?php

        require_once "Classes/ConnectionDB.php";
        $loggedInAsAdmin = false;

        $usernameOrEmail = "";
        $password = "";

        if (isset($_POST["submit"])) {
            $passFound = false;
            $userFound = false;
            if (isset($_POST["usernameEmail"])) {
                $usernameOrEmail = $_POST["usernameEmail"];
                $userFound = true;
            }
            if (isset($_POST["password"])) {
                $password = $_POST["password"];
                $passFound = true;
            }
            if ($passFound && $userFound) {
                $pdo = ConnectionDB::getInstance();
                $stmt = $pdo->prepare("
                    SELECT * FROM User WHERE
                    (username = :usernameEmail OR
                    email = :usernameEmail)
                ");
                $stmt->execute([
                    ':usernameEmail' => $usernameOrEmail
                ]);
            
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($password, $user['password'])) {
                    header("Location: home.php");
                    exit();
                } else {
                    echo "User does not exist.";
                }
            }
        }

    ?>

</body>
</html>