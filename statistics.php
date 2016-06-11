<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$userkit = $_SESSION['userkit'];

?>

<!DOCTYPE html>
<html>
<head>

	<title>AppTeczka - statystyka</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<!-- zewnętrzne -->
	<link href="static/css/bootstrap.min.css" rel="stylesheet">
	<link href="static/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- skrypty -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>

	<!-- dedykowane -->
	<link rel="stylesheet" type="text/css" href="static/css/theme.css">

</head>

<body>

<?php

if ($username && $userid) {
	/*CHODZI TU O SPR ZALOGOWANIA*/
	?>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav"
						id="droppedDownButt">
					<div class="burger-menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>
				</button>
				<a href="index.php"><h1>AppTeczka</h1></a>
			</div>
			<div class="collapse navbar-collapse" id="myNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn btn-n" id="buton" href="index.php" role="button">strona domowa</a></li>
					<li><a class="btn btn-n" id="buton" href="member.php" role="button">Twoja apteczka</a></li>
					<li><a class="btn btn-n" id="buton" href="statistics.php" role="button">statystyki</a></li>
					<li><a class="btn btn-n" id="buton" href="documentation.php" role="button">dokumentacja</a></li>
					<li><a class="btn btn-n" id="buton" href="logout.php" role="button">wyloguj się</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<?php

} else {

	?>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="index.php"><h1>AppTeczka</h1></a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>

	<?php
}
?>
<div>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {packages: "corechart"});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var chart1 = gooogle.visualisation.arrayToDataTable([
				['Plec', 'Ilosc'],
				['kobiety', 'seiradanych'],
				['mezyczyzni', 'seria2'],
			]);

			var options_chart1 = {
				title: 'Eloszka',
				backgroundColor: 'ten co wszedzie',
			};

			var chart_chart1 = new.google.visualisation.ColumnChart(document.getElementById('chart1'));

			chart_chart1.draw(chart1, options_chart1);
		}
	</script>
</div>

<!-- rysowanie potem <div id="chart1" style="width: 700px; height: 400px;"></div>
-->

<section class="jumbotron">
	<div class="container">
		<div class="wrapper">
			<h1>kiedyś coś</h1>
			<h3>będzie się dało tu cokolwiek zrobić jak zadziała 'zreaktywowana' baza danych</h3>
			<h4>ogólnie myślałam o wykresie ile zjadło się tabletek danego dnia, jako wykres słupkowy w meisiącu, miesiąc mógłby być z selecta</h4>
			<h5>i jakiś taki liniowy wykres ile piniędzy poszło się paść przez marnacje</h5>

		</div>
	</div>
</section>

<footer>
	<div class="stopka">
		<p>&copy; BIOMEDIXPOL 2016</p>
		<p>projekt z przedmiotu Systemy Informatyczne w Medycynie</p>
	</div>
</footer>

</body>
</html>