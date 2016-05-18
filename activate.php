<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>

<html>
<head>

	<title>AppTeczka - aktywacja konta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="mine_main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
	
</head>
<body>

<header>					
		<H1>Apteczka domowa</H1>  
		<H4>Projekt semestralny z przedmiotu SIwM</H4>
</header>

<div id="Menu">
<ul>
	<li><a href = "login.php">Zaloguj się</a></li>
	<li><a href = "member.php">Strona domowa</a></li>
	<li><a href = "home.php">Twoja domowa apteczka</a></li>
	<li><a href = "documentation.php">Statystki</a></li>
	<li><a href = "documentation.php">Dokumentacja</a></li>
	<li><a href = "logout.php">Wyloguj się</a></li>
</ul>
</div>

<?php

	$getuser = $_GET['user'];
	$getcode = $_GET['code'];
	
	
	if ($_POST['activatebtn']) {
		$getuser = $_POST['user'];
		$getcode = $_POST['code'];
		
		if ($getuser) {
			if ($getcode) {
				require("./connect.php");
				
				$query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
				$numrows = mysql_num_rows($query);
				
				if ($numrows == 1) {
					$row = mysql_fetch_assoc($query);
					$dbcode = $row['code'];
					$dbactive = $row['active'];
					
					if ($dbactive == 0) {
						if ($dbcode == $getcode) {
							mysql_query("UPDATE users SET active='1' WHERE username='$getuser'");
							$query = mysql_query("UPDATE users SET active='1' WHERE username='$getuser' AND active='1'");
							$numrows = mysql_num_rows($query);
							
							if ($numrows == 1) {
								$errormsg = "Twoje konto zostało aktywowane";
								$getuser = "";
								$getcode = "";
							} else {
								$errormsg = "Wystąpił błąd. Twoje konto nie zostało aktywowane.";
							}
						} else {
							$errormsg = "Wprowadzono niepoprawny kod.";
						}
					} else {
						$errormsg = "Twoje konto zostało już aktywowane.";
					}
				} else {
					$errormsg = "Nie znaleziono użytkownika o podanej nazwie.";
				}
			} else {
				$errormsg = "Musisz wprowadzić swój kod aktywacyjny.";
			}
		} else {
			$errormsg = "Musisz wpisać nazwę użytkownika.";
		}
	} else 
	
	$errormsg = "";
	echo "<form action='./activate.php' method='post'>
	
	<table>
	
	<tr>
		<td></td>
		<td>$errormsg</td>
	</tr>
	
	<tr>
		<td>Nazwa użytkownika:</td>
		<td><input type='text' name='user' value='$getuser' placeholder='Wprowadź nazwę użytkownika' required></td>
	</tr>
	
	<tr>
		<td>Kod aktywacyjny:</td>
		<td><input type='text' name='code' value='$getcode' placeholder='Wprowadź kod aktywacyjny' required></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type='submit' name='activatebtn' value='Aktywuj' /></td>
	</tr>
	
	</form>";

?>

</body>
</html>

