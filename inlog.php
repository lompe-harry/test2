<?php
	// start de sessie
 	session_start();
	
    // is de inlog-knop wel naar deze pagina gestuurd
	if (isset($_POST['inlog'])){
        // voeg het config bestand toe
        require 'config.php';
        //zet errors aan
        ini_set('display_errors', 'On');
        //lees het inlog-formulier uit
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = sha1($_POST['wachtwoord']);
            
        // maak de inlog-query
        $inlog = "SELECT * FROM dbusers WHERE gebruikersnaam = '$gebruikersnaam' AND wachtwoord = '$wachtwoord'";
            
        // vang het resultaat van de query op in 'resultaat'
        $resultaat = mysqli_query($mysqli, $inlog);
            
        // controleer of het resultaat iets heeft opgelevert
        if (mysqli_num_rows($resultaat) > 0)
        {
			// haal de user uit het resultaat
			$user = mysqli_fetch_array($resultaat);
			// zet zowel de gebruikersnaam als level in de session
			$_SESSION['gebruikersnaam'] = $user['gebruikersnaam'];
			$_SESSION['level'] = $user['level'];
			// geef de als de melding bij een juiste inlog
            /*echo "<p>Goeiedag $gebruikersnaam, u bent ingelogd!</p>";
            echo "<p><a href='user-toon.php'>Ga verder</a></p>";*/
			header('Location: http://bart.telstar-web.nl/crud2/user-toon.php');
			exit;
        }
        else
        {
			// als er een verkeerde inlog is
            echo "<p>Naam en/of wachtwoord zijn onjuist.</p>";
            echo "<p><a href='inlog.php'>Probeer opnieuw</a></p>";	
        }
    }
	// als het formulier niet goed doorgekomen is
    else
    {	
        echo "<h2> Login </h2>";
        echo "<form method='post' action=''>";
        echo "<table border='0'>";
       	echo "<tr>";
        echo "<td>gebruikersnaam</td>";
       	echo "<td><input type='text' name='gebruikersnaam' /></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>wachtwoord</td>";
        echo "<td><input type='password' name='wachtwoord' /></td>";
        echo "</tr>";
       	echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td><input type='submit' name='inlog' value='Log in' /></td>";
      	echo "</tr>";
        echo "</table>";
        echo "</form>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Inlog</title>
    </head>

    <body>
    </body>
</html>
