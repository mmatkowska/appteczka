<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>

<html>
<head>

	<title>AppTeczka - strona domowa</title>
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
	echo "Witaj <b>$username</b>. <br> Poniżej wypisane są leki znajdujące się w Twojej apteczce. <br><br>";
	require("connect.php");

	$query = "SELECT * FROM drugs"; 
	$result = mysql_query($query);
	$name = "nazwa leku";
	$expiration_date = "data ważności";
	$quantity = "ilość tabletek";
	$price = "cena";

	echo "<table>"; 
	echo "<tr><td>" . $name . str_repeat('&nbsp;', 3) . "</td><td>" . $expiration_date . str_repeat('&nbsp;', 3) . "</td><td>" . $quantity . str_repeat('&nbsp;', 3) . "</td><td>" . $price . "</td></tr>";  
	while($row = mysql_fetch_array($result)) {   
		echo "<tr><td>" . $row['name'] . str_repeat('&nbsp;', 3) . "</td><td>" . $row['expiration_date'] . str_repeat('&nbsp;', 3) . "</td><td>" . $row['quantity'] . str_repeat('&nbsp;', 3) . "</td><td>" . $row['price'] . "</td></tr>";  
	}

	echo "</table><br>"; 

	mysql_close();
}
else {
echo "Zaloguj się. <a href='./login.php'>Zaloguj</a>";
}

?>

<a class="btn btn-primary" href="add_new.php" role="button">dodaj nowy lek</a>

<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>
