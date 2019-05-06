<?php
// start de sessie
session_start();
// als de gebruiker niet is ingelogd bestaat er geen sessie
if(!isset($_SESSION['gebruikersnaam']))
{
	header("location:logout.php");	
}
// als de gebruiker wel is ingelogd mag hij verder, en kan hij uitloggen
else
{
	echo "<p>Welkom, " . $_SESSION['gebruikersnaam'] . "  |  <a href='logout.php'>Uitloggen</a></p>";
}
// voeg het config bestand toe
require 'config.php';

//zet errors aan
ini_set('display_errors', 'On');

//haal het user-id uit de url
$userid = $_GET['id'];

// maak de query en onthoud de id als $userid
$query = "SELECT * FROM dbusers WHERE ID = " . $userid;

// vang het resultaat van de query op in 'resultaat'
$resultaat = mysqli_query($mysqli, $query);

// als er geen gegevens zijn
if (mysqli_num_rows($resultaat) == 0)
{
	echo "<p>Er is geen user met ID $userid.</p>";
}
// als er wel gegevens zijn
else
{
	// haal de rij 'user' uit het resultaat
	$rij = mysqli_fetch_array($resultaat);
	// zet de gegevens van de user in een tabel
	echo "<h2>Gegevens van user met ID $userid:</h2>";
	echo "<table border='1'>";
	echo "<tr><td>email:</td>";
	echo 	"<td>" . $rij['email'] . "</td></tr>";
	echo "<tr><td>gebruikersnaam:</td>";
	echo 	"<td>" . $rij['gebruikersnaam'] . "</td></tr>";
	echo "<tr><td>wachtwoord:</td>";
	echo 	"<td>" . $rij['wachtwoord'] . "</td></tr>";
	echo "<tr><td>level:</td>";
	echo 	"<td>" . $rij['level'] . "</td></tr>";
	echo "</table>";
}

echo "<p><a href='user-toon.php'>Terug</a> naar het overzicht.</p>";
?>