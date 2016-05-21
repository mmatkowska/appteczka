<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>AppTeczka - nowy lek</title>
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

    $form = "<form action='./add_new.php' method='post'>
        
    <table>

	<tr>
		<td>Numer EAN leku:</td>
		<td><input type='text' name='ean' placeholder='Wprowadź numer EAN' required></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['submitbtn']) {
        $ean = $_POST['ean'];

        require("connect.php");

        $query = mysql_query("SELECT FROM drugs_specification WHERE ean = $ean");
        $numrows = mysql_num_rows($query);

        if ($numrows == 1) {
            $name_query = mysql_query("SELECT name FROM drugs_specification WHERE ean = $ean");
		}
        mysql_close();

        echo "Dodałeś lek $name do apteczki.";
    } else {
        echo $form;
    }
} else {
    echo "Jesteś niezalogowany. <a href='./login.php' class='btn btn-n'>Zaloguj</a>";
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
