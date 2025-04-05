<?php

include "header.html";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <br>
    <br>
    <br>

    <div>
        <form action="" method="post">
            <p>Are you sure you want to logout?</p>
            <button type="submit" name="confirm" value="yes">Yes</button>
            <button type="submit" name="confirm" value="no">No</button>
        </form>
    </div>
    
    <?php

        require_once "Classes/SessionManagerClass.php";

        $sess = new SessionManager();

        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] === 'yes') {
                $sess->destroySession();
                header('Location: ./index.php');
                exit();
            } elseif ($_POST['confirm'] === 'no') {
                header('Location: ./home.php');
                exit();
            }
        }

    ?>

</body>
</html>