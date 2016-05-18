<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>
<html>
<head>

	<title>AppTeczka</title>
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
	
	<section class="jumbotron">
		<div class="container">
			<div class="row text-center">
				<h2>AppTeczka</h2>
				<h3>uporządkuj swoje leki</h3>
				<a class="btn btn-primary" href="login.php" role="button">zaloguj się</a>
			</div>
		</div>
	</section>
	
	<section class="container">
		<div class="row">
			<div class="col-sm-6">
				<h3>generuj raporty</h3>
				<i class="fa fa-area-chart" style="font-size:78px;color:#759bb6"></i>
			</div>
			<div class="col-sm-6">
				<h3>monitoruj swoją domową apteczkę</h3>
				<i class="fa fa-medkit" style="font-size:78px;color:#759bb6"></i>
			</div>
			<div class="col-sm-6">
				<h3>dbaj o domowników</h3>
				<i class="fa fa-heartbeat" style="font-size:78px;color:#759bb6"></i>
			</div>
		</div>
	</section>

<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>