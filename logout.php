<?php
// start de sessie
session_start();
// leeg de array
$_SESSION = array();
// vernietig de sessie
session_destroy();
// ga terug naar de inlogpagina
header("location:inlog.php");
?>