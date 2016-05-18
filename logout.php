<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>

<html>
<head>

	<title>AppTeczka - wyloguj się</title>
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

if ($username && $userid) {
	session_destroy();
	echo "Zostałeś wylogowany.";
	}
else {
	echo "Nie jesteś zalogowany.";
	}


?>

<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>

