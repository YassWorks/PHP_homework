<?php 

include "header.html"; 
require_once "Classes/SessionManagerClass.php";

$sess = new SessionManager();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <?php
        require_once "Classes/ConnectionDB.php";
        require_once "Classes/SessionManagerClass.php";

        $sess = new SessionManager();
        $SessionID = $sess->getValueByKey("SuccessfulLogin");
        if(isset($SessionID)){
            echo '
                <div id="wlcm">
                    <p>Hello, PHP LOVERS! Welcome to your administration Platform!</p>
                </div>
            
            ';
        }else{
            header("Location: index.php");
            exit();
        }
    ?>


</body>
</html>