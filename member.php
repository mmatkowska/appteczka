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

    <title>AppTeczka - Twoja apteczka</title>
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

<section class="jumbotron">
    <div class="container">
        <div class="wrapper">
            <?php

            if ($username && $userid) {
                echo "Witaj <b>$username</b>. <br> Poniżej wypisane są leki znajdujące się w Twojej apteczce. <br><br>";
                require("connect.php");
                $join_query = "SELECT * FROM drugs_in_kit INNER JOIN drugs_specification ON drugs_in_kit.drugs_specification_id=drugs_specification.id";
                $result = mysql_query($join_query);
                if ($result) {
   					$name = "nazwa leku";
                	$expiration_date = "data ważności";
                	$quantity = "ilość tabletek";
                	$price = "cena";

					if ($join_query == 0) {
							echo "<table>";
                			echo "<tr><td>" . $name . str_repeat('&nbsp;', 3) . "</td><td>" . $expiration_date . str_repeat('&nbsp;', 3) . "</td><td>" . $quantity . str_repeat('&nbsp;', 3) . "</td><td>";
                			  while($row = mysql_fetch_array($result)) {
                    				echo "<tr><td>" . $row['name_spec'] . str_repeat('&nbsp;', 3) . "</td><td>" . $row['best_before'] . str_repeat('&nbsp;', 3) . "</td><td>" . $row['quantity_left'] . "</td></tr>";
                				}
                    		echo "</table><br>";
						}
                			mysql_close();
                			?><a class="btn btn-n" href="search.php" role="button">dodaj nowy lek</a><a class="btn btn-n" href="drug_use.php" role="button">zgłoś użycie leku</a><?php
				} else {
					die('Invalid query: ' . mysql_error());
				}
        	} else {
                echo "Jesteś niezalogowany. <br> <a href='./login.php' class='btn btn-n'>zaloguj się</a>";
            }

            ?>

        </div>

        <div class="wrapper">
             COŚ NIE TAK DATA SIĘ WPISUJE ... I JESZCZE TRZEBA ZROBIĆ ŻEBY SIĘ KALENDARZ ROZWIJAŁ PRZY DODAWANIU DATY WAŻNOŚCI LEKU WCZEŚNIEJ TAK BYŁO A TERAZ NIE MOGĘ COŚ TEGO USTAWIĆ
        </div>
        
		<div class="wrapper">
              wyszukiwanie na dziś już mi nie siadło.. jak coś to mogę to zrobić w tygodniu - G.
        </div>

        <div class="wrapper">
            +myślałam jeszcze o bajerze w javascripcie (jeszcze nie umiem tego zrobić ale się nauczę) z wyskakującym okienkiem z powiadomieniem, że w przeciągu miesiąca jakiś lek się psuje
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
