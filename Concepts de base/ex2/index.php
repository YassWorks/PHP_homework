<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Manager Testing</title>
</head>
<body>

    <h2>Centre de Shopping En ligne</h2>
    
    <div>
        <?php
            require_once "SessionManagerClass.php";

            $sess = new SessionManager();
            $msg = "";

            if (isset($_POST['reset_button'])) {
                $sess->destroySession();
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }

            $SessionID = $sess->getValueByKey("SessionID");
            if (!isset($SessionID)) {
                $msg = "Bienvenu à notre plateforme.";
                $sess->addItemToSession("SessionID", $_COOKIE['PHPSESSID']);
                $sess->addItemToSession("#visits", 1);
            } else {
                $sess->addItemToSession("#visits", $sess->getValueByKey("#visits") + 1);
                $n = $sess->getValueByKey("#visits");
                $msg = "Merci pour votre fidélité, c’est votre {$n}éme visite.";
            }

            echo $msg;

        ?>
    </div>
    <br>
    <br>
    <br>

    <form action="" method="post">
        <button type="submit" name="reset_button">réinitialiser la session</button>
    </form>
    
</body>
</html>