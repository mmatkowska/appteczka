<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>

<html>
<head>

	<title>AppTeczka - zarejestruj się</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="mine_main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
	
</head>
<body>

<header class="container">
		<div class="row">
			<h1 class="col-sm-4">AppTeczka</h1>
			<nav class="col-sm-8">
				<a class="btn btn-primary" href="index.php" role="button">strona domowa</a>
				<a class="btn btn-primary" href="member.php" role="button">Twoja domowa apteczka</a>
				<a class="btn btn-primary" href="statistics.php" role="button">statystyki</a>
				<a class="btn btn-primary" href="documentation.php" role="button">dokumentacja</a>
				<a class="btn btn-primary" href="logout.php" role="button">wyloguj się</a>
			</nav>
		</div>
	</header>

<?php

if ($_POST['registerbtn']) {
	$getuser = $_POST['user'];
	$getemail = $_POST['email'];
	$getpassword = $_POST['password'];
	$getretypepassword = $_POST['retypepassword'];
	
	if ($getuser) {
		if ($getemail) {
			if ($getpassword) {
				if ($getretypepassword) {
					if ($getpassword === $getretypepassword) {
						if ((strlen($getemail) >= 7) && (strstr($getemail, "@")) && (strstr($getemail, "."))) {
							require("./connect.php");
							
							$query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
							$numrows = mysql_num_rows($query);
							
							if ($numrows == 0) {
								$query = mysql_query("SELECT * FROM users WHERE email='$getemail'");
								$numrows = mysql_num_rows($query);
								if ($numrows == 0) {
									$date = date("F d, Y");
									$code = md5(rand());
									$password = md5(md5($password));
							
									mysql_query("INSERT INTO users VALUES (
										'', '$getuser', '$password', '$getemail', '0', '$code', '$date'
									)");
									
									$query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
									$numrows = mysql_num_rows($query);
									
									if ($numrows == 1) {
									
										$site = "http://student.agh.edu.pl/~mmatkow";
										$webmaster = "mmatkowska <mmatkowska1@gmail.com>";
										$headers = "From: $webmaster";
										$subject = "Domowa apteczka - aktywacja konta.";
										$message = "Dziękuję za zarejestrowanie się. Kliknij w poniższy link aby aktywować swoje konto.\n";
										$message .= "$site/activate.php?user=$getuser&code=$code\n";
										$message .= "Twój kod aktywacyjny: $code\n";
										$message .= "Aby się zalogować należy aktywować swoje konto.";
										
										if (mail($getemail, $subject, $message, $headers)) {
											$errormsg = "Zostałeś zarejestrowany. Musisz aktywować swoje konto poprzez link aktywacyjny przesłany na adres <b>$getemail</b>.";
											$getuser = "";
											$gemail = "";
										} else {
											$errormsg = "Wystąpił błąd. Twój email aktywacyjny nie został wysłany.";
										}
									} else {
										$errormsg = "Wystąpił błąd. Twoje konto nie zostało utworzone.";
									}
								} else {
									$errormsg = "Istnieje już użytkownik o takim adresie email.";
								}
							} else {
								$errormsg = "Istnieje już użytkownik o takiej nazwie.";
							}
							
							mysql_close();
						} else {
							$errormsg = "Musisz wpisać prawidłowy adres email.";
						}
					} else {
						$errormsg = "Podane hasła nie są takie same.";
					}
				} else {
					$errormsg = "Musisz potwórzyć swoje hasło aby się zarejestrować.";
				}
			} else {
				$errormsg = "Musisz podać hasło aby się zarejestrować.";
			}
		} else {
			$errormsg = "Musisz podać email aby się zarejestrować.";
		}
	} else {
		$errormsg = "Musisz podać nazwę użytkownika aby się zarejestrować.";
	}
} 

$form = "<form action='./register.php' method='post'>

	<table>
		<tr>
			<td></td>
			<td><font color='red'>$errormsg</font></td>
		</tr>
		
		<tr>
			<td>Nazwa użytkownika:</td>
			<td><input type='text' name='user' value='$getuser' placeholder='Wprowadź nazwę użytkownika' required></td>
		</tr>
		
		<tr>
			<td>Adres email:</td>
			<td><input type='text' name='email' value='$getemail' placeholder='Wprowadź adres email' required></td>
		</tr>
		
		<tr>
			<td>Hasło:</td>
			<td><input type='password' name='password' value='$getpassword' placeholder='Wprowadź hasło' required></td>
		</tr>
		
		<tr>
			<td>Powtórz hasło:</td>
			<td><input type='password' name='retypepassword' value='$getretypepassword' placeholder='Potwórz hasło' required></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type='submit' name='registerbtn' value='Zarejestruj się' /></td>
		</tr>
	</table>

</form>";

echo $form;

?>


<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>