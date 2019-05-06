<?php
// start de sessie
session_start();
// als de gebruiker niet is ingelogd bestaat er geen sessie
if(!isset($_SESSION['gebruikersnaam']))
{
	header("location:logout.php");	
}
// als de gebruiker wel is ingelogd mag hij verder, ook staat er een uitlog mogelijkheid voor de gebruiker
else
{
	echo "<p>Welkom, " . $_SESSION['gebruikersnaam'] . "  |  <a href='logout.php'>Uitloggen</a></p>";
}
// voeg het config bestand toe
require 'config.php';
//zet errors aan
ini_set('display_errors', 'On');

// maak de query
$query = "SELECT * FROM dbusers";

// vang het resultaat van de query op in 'resultaat'
$resultaat = mysqli_query($mysqli, $query);

// als er geen gegevens gevonden zijn
if (mysqli_num_rows($resultaat) == 0)
{
	echo "<p>Er zijn geen resultaten gevonden!</p>";
}

// als er wel gegevens zijn
else
{
	// maak een tabel
	echo "<table border='1'>";
	// via een while-lus worden alle rijen getoond
	while ($rij = mysqli_fetch_array($resultaat))
	{
		echo "<tr>";
		echo "<td>" . $rij['ID'] . "</td>";
		echo "<td>" . $rij['email'] . "</td>";
		echo "<td> <a href='user-detail.php?id=".$rij['ID']."'>details</a></td>";
		if ($_SESSION['level'] > 1){
		echo "<td> <a href='user-wijzig.php?id=".$rij['ID']."'>wijzig</a></td>";
		echo "<td> <a href='user-verwijder.php?id=".$rij['ID']."'>verwijder</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	
	echo "<p>Nieuwe users <a href='user-toevoeg.php'>Toevoegen</a></p>";
}
?>