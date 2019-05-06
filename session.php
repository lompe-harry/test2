<?php
// start de sessie
session_start();
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
// als de gebruiker niet is ingelogd bestaat er geen sessie
if(!isset($_SESSION['gebruikersnaam']))
{
	header("location:logout.php");	
}
// als de gebruiker wel is ingelogd mag hij verder
else
{
	echo "<p>Welkom, " . $_SESSION['gebruikersnaam'] . "  |  <a href='logout.php'>Uitloggen</a></p>";
	// als de gebruiker een level 1 heeft
	if ($_SESSION['level'] == 1)
	{
		echo "<p>U heeft geen rechten om deze pagina te bekijken!</p>";
		echo "<p><a href='user-toon.php'>Ga Terug</a></p>";
		exit();
	}
}
?>