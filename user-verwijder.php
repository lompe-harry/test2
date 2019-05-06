<?php
// voeg de sessie toe
require 'session.php';
// voeg het config bestand toe
require 'config.php';

//zet errors aan
ini_set('display_errors', 'On');

//haal het user-id uit de url
$userid = $_GET['id'];

// maak de query
$query = "SELECT * FROM dbusers WHERE ID = " . $userid;

// vang het resultaat van de query op in 'resultaat'
$resultaat = mysqli_query($mysqli, $query);

// als er geen gegevens zijn
if (mysqli_num_rows($resultaat) == 0)
{
	echo "<p>Er is geen user met ID $userid.</p>";
}
else
{
		// als er niks verstuurd is
		$rij = mysqli_fetch_array($resultaat);
		?>
		<h2>Wilt u de volgende user verwijderen?</h2>
		<form name="form1" method="post" action="user-verwijder-verwerk.php">
			<input type="hidden" name="ID" value="<?php echo $rij['ID']?>" >
			<input type="hidden" name="gebruikersnaam" value="<?php echo $rij['gebruikersnaam'] ?>">
			<p>Gebruikersnaam: <?php echo $rij['gebruikersnaam'] ?></p>
			<p><input type="submit" name="submit" value="verwijder" /></p>
		</form>
		<?php
	}
	echo "<p><a href='user-toon.php'>Terug</a> naar het overzicht.</p>";
?>