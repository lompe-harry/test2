<?php
require 'session.php'; 				// voeg de sessie toe
require 'config.php'; 				// voeg het config bestand toe
ini_set('display_errors', 'On'); 	// zet errors aan
$userid = $_GET['id']; 				// haal het user-id uit de url

// maak de query
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
	$rij = mysqli_fetch_array($resultaat);
	
	?>
    <h2>Wijzig de gegevens van <?php echo $rij['gebruikersnaam'] ?></h2>
    <form name="fotm1" method="post" action="user-wijzig-verwerk.php">
    	<table width="200" border="0">
    		<tr>
            	<td>ID:</td>
                <td><input type="number" name="ID" value="<?php echo $rij['ID'] ?>" readonly/></td>
            </tr>
            <tr>
            	<td>email</td>
                <td><input type="email" name="email" value="<?php echo $rij['email'] ?>"/></td>
            </tr>
            <tr>
            	<td>gebruikersnaam</td>
                <td><input type="text" name="gebruikersnaam" value="<?php echo $rij['gebruikersnaam'] ?>"/></td>
            </tr>
            <tr>
            	<td>wachtwoord</td>
                <td><input type="password" name="wachtwoord" value=""/></td>
                <td><input type="hidden" name="wachtwoord" value="<?php echo $rij['wachtwoord']?>"/></td>
            </tr>
            <tr>
            	<td>level</td>
                <td><input type="number" name="level" value="<?php echo $rij['level'] ?>"/></td>
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input type="submit" name="submit" value="opslaan"/></td>
            </tr>
    	</table>
    </form>
    <?php
}
echo "<p><a href='user-toon.php'>Terug</a> naar het overzicht.</p>";
?>