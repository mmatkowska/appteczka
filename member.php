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
                ?>
                <a class="btn btn-n" href="add_new.php" role="button">dodaj nowy lek</a>
                <?php
            }
            else {
                echo "Jesteś niezalogowany. <br> <a href='./login.php' class='btn btn-n'>zaloguj się</a>";
            }

            ?>

        </div>

        <div class="wrapper">
            tu będzie zgłaszanie tego, że coś zużyto, czyli wysyłanie do DRUGS_OUT, odswieżenie strony (+obliczenie ile zostało)
        </div>

        <div class="wrapper">
            tu może wyszukiwanie po typie? w sensie, że div z całą bazą uaktualni się na dany typ wybrany tutaj

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
