<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>

<html>
<head>

	<title>AppTeczka - dodaj lek</title>
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

     $form = "<form action='./add_new.php' method='post'>
        
    <table>

	<tr>
		<td>Nazwa leku:</td>
		<td><input type='text' name='name' placeholder='Wprowadź nazwę leku' required></td>
	</tr>
	
	<tr>
		<td>Data wazności:</td>
		<td><input type='date' name='expiration_date' placeholder='Wprowadź datę ważności' required></td>
	</tr>
	
	<tr>
		<td>Liczba tabletek:</td>
		<td><input type='number' name='quantity' placeholder='Wprowadź liczbę tabletek' required></td>
	</tr>
	
	<tr>
		<td>Cena:</td>
		<td><input type='number' name='price' placeholder='Wprowadź cenę' required></td>
	</tr>

	<tr>
		<td></td>
		<td><input type='submit' name='submitbtn' value='Dodaj lek' /></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['submitbtn']) {
        $name = $_POST['name'];
        $expiration_date = $_POST['expiration_date'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        require("connect.php");
        
        $query = mysql_query("INSERT INTO drugs (name, expiration_date, quantity, price) values ('$name', '$expiration_date', '$quantity', '$price')");
        mysql_close();
		
		echo "Dodałeś lek $name do apteczki.";
        } else {
        echo $form;
		}      
} else {
    echo "Zaloguj się. <a href='./login.php'>Zaloguj</a>";
}

?>

<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>