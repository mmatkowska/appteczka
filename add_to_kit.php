<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$userkit = $_SESSION['userkit'];
$spec_id = $_SESSION['drug_id'];

?>

<!DOCTYPE html>
<html>
<head>

    <title>AppTeczka - dodaj lek</title>
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

  $form = "<form action='./add_to_kit.php' method='post'>
        
    <table>
	<tr>
		<td>Data wazności:</td>
		<td><input type='date' name='expiration_date' placeholder='YYYY-mm-dd' required></td>
	</tr>
	
	<tr>
		<td>Liczba tabletek:</td>
		<td><input type='number' name='quantity' placeholder='Wprowadź liczbę tabletek' required></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type='submit' name='addbtn' value='Dodaj lek do apteczki' /></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['addbtn']) {
         $quantity=$_POST['quantity'];
         $date=$_POST['expiration_date'];
         			
    	if($quantity) {
         	if($date) {
         		require("./connect.php");
         		$query = mysql_query("INSERT INTO drugs_in_kit VALUES ('', '$quantity', '$date', '$userkit', '$spec_id')");
         		if ($query == false) {
         			echo mysql_error();
         		}
         		mysql_close();
         		echo "Dodałeś lek do apteczki.<a class='btn btn-n' href='member.php' role='button'>wróć do apteczki</a>";
         	} else {
         		echo "Wpisz datę ważności leku.";
         	}
         } else {
         	echo "Wpisz ilość tabletek, jaką chcesz włożyć do apteczki.";
         }
    } else {
        echo $form;
    }
} else {
    echo "Jesteś niezalogowany. <a class='btn btn-n' href='login.php' role='button'>zaloguj się</a>";
}

?>
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
