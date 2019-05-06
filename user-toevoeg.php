<?php
	require 'session.php';
	
	//disable cache
	opcache_reset();
	
	//zet errors aan
	ini_set('display_errors', 'On');
	
	$errorMsg = array();
	
	// is er wel op de submitknop gedrukt
	if (isset($_POST['submit'])){
		// voeg het config bestand toe
		require 'config.php';
			
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		//lees het formulier uit
		$email = test_input($_POST['email']);
		$gebruikersnaam = test_input($_POST['gebruikersnaam']);
		$wachtwoord =  test_input($_POST['wachtwoord']) ? test_input(sha1($_POST['wachtwoord'])) : NULL;		
		$level = test_input($_POST['level']);
			
		if ( !$email ) $errorMsg['email'] = 'Geen email';
			else $errorMsg['email'] = NULL;
		
		if ( !$gebruikersnaam ) $errorMsg['gebruikersnaam'] = 'Geen gebruikersnaam';
			else $errorMsg['gebruikersnaam'] = NULL;
			
		if ( !$wachtwoord ) $errorMsg['wachtwoord'] = 'Geen wachtwoord';
			else $errorMsg['wachtwoord'] = NULL;
			
		if ( !$level ) $errorMsg['level'] = 'Geen level';
			else $errorMsg['level'] = NULL;
		
		$errorMsg = array_filter($errorMsg);
		
		if (!empty($errorMsg)) {
			/*print_r( $errorMsg );
			foreach ( $errorMsg as $value ) {
				echo $value.'<br />';
			}*/
			echo "<p>Let op! Alle velden moeten worden ingevuld</p>";

		} else {			
			// maak de query
			$query = "INSERT INTO dbusers VALUES (NULL, '$email', '$gebruikersnaam', '$wachtwoord', $level)";
							
			// voer de opdracht uit
			if(mysqli_query($mysqli, $query)){	
				echo "<p>User $gebruikersnaam is toegevoegd!</p>";
			} else {
				echo "<p>Er is een fout opgetreden bij het toevoegen</p>";
				echo mysqli_error($mysqli);
			}
		}
	}
?>

<!doctype html>
<html lang="en">
  	<head>
    	<meta charset="utf-8">        
        <title>Crud - inlog</title>
        <link rel="stylesheet" href="css/main.css"/>
  	</head>

	<body>
    	<section>
        	<h2>Voeg een gebruiker toe</h2>
            	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                	<table border="0">
						<tr>
                           	<td>Email addres</td>
                     		<td><input type="email" name="email" aria-describedby="email"></td>
                            <td><span class="error"> <?=(isset($errorMsg['email']))? $errorMsg['email'] : NULL?></span></td>
                      	</tr>
                        <tr>
                            <td>Volledige Naam</td>
                            <td> <input type="text" name="gebruikersnaam"></td>
                            <td><span class="error"> <?=(isset($errorMsg['gebruikersnaam'])) ? $errorMsg['gebruikersnaam'] : NULL?></span></td>
                        </tr>
                        <tr>
                            <td>Wachtwoord</td>
                            <td><input type="password" name="wachtwoord"></td>
                            <td><span class="error"> <?=(isset($errorMsg['wachtwoord'])) ? $errorMsg['wachtwoord'] : NULL?></span></td>
                       	</tr>
                        <tr>
                        	<td>Level</td>
                            <td><input type="radio" name="level" value="1" checked>1
                            <input type="radio" name="level" value="2">2
                            <input type="radio" name="level" value="3">3</td>
                            <td><span class="error"> <?=(isset($errorMsg['level'])) ? $errorMsg['level'] : NULL?></span></td>
                       	</tr>
                     </table>
                     <p>level 1 is gebruiker, level 2 is superuser, level 3 is admin</p>
                     <button type="submit" name="submit">Submit</button>    
				</form>
                            
        	<p><a href='user-toon.php'>Toon de users</a></p>
    	</section>
    </body>
</html>