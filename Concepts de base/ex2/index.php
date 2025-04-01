<?php

require_once "SessionManagerClass.php";

$sess = new SessionManager();
$sess->addItemToSession("id", 123);
$sess->addItemToSession("id", 125);

?>