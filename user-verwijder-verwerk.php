<?php
// voeg de sessie toe
require 'session.php';

// is de submitknop wel naar deze pagina gestuurd
if (isset($_POST['submit'])){
	// voeg het config bestand toe
	require 'config.php';
	//zet errors aan
	ini_set('display_errors', 'On');
	//lees het formulier uit
	$ID = $_POST['ID'];
	$gebruikersnaam = $_POST['gebruikersnaam'];
	
	// maak de query
	$query = "DELETE FROM dbusers WHERE ID = $ID";
	
	//echo $query . "</br>";
	
	// voer de opdracht uit
	if(mysqli_query($mysqli, $query))
	{
		echo "<p>User $gebruikersnaam is Verwijderd!</p>";
	}
	else
	{
		echo "<p>Er is een fout opgetreden bij het Verwijderen!</p>";
		//echo mysqli_error($mysqli);
	}
}
else
{
	echo "<p>geen gegevens ontvangen</p>";
}

echo "<p><a href='user-toon.php'>Terug</a> naar het overzicht.</p>";
?>