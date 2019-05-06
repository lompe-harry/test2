<?php
// voeg de sessie toe
require 'session.php';

ini_set('display_errors', 'On');
// is de submitknop wel naar deze pagina gestuurd
if (isset($_POST['submit'])){
	//voeg de koppeling naar de database toe
	require 'config.php';
	//lees het formulier uit
	$ID = $_POST['ID'];
	$email = $_POST['email'];
	$gebruikersnaam = $_POST['gebruikersnaam'];
	$wachtwoord = $_POST['wachtwoord'] ? sha1($_POST['wachtwoord']) : $rij['wachtwoord'];
	$level = $_POST['level'];
	
	// maak de query
	$query = "UPDATE dbusers SET email= '$email', gebruikersnaam = '$gebruikersnaam', wachtwoord = '$wachtwoord', level = '$level' WHERE ID = $ID";
		
	// voer de opdracht uit
	if(mysqli_query($mysqli, $query))
	{
		echo "<p>User $gebruikersnaam is Aangepast!</p>";
	}
	else
	{
		echo "<p>Er is een fout opgetreden bij het Wijzigen!</p>";
		echo mysqli_error($mysqli);
	}
}
else {
	echo "<p>Geen gegevens ontvangen!</p>";	
}

echo "<p><a href='user-toon.php'>Terug</a> naar het overzicht.</p>";
?>