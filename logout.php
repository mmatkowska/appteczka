<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>

    <title>AppTeczka - wylogowanie</title>
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
                <h1>AppTeczka</h1>
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
                <h1>AppTeczka</h1>
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
    session_destroy();
    echo "Zostałeś wylogowany. Za chwilę zostaniesz przekierowany na stronę główną." ?> <!--ZOBACZYMS-->
    <meta http-equiv="refresh" content="3;url=/index.php" />
    <?php
}
else {
    echo "Jesteś niezalogowany."; ?>
            <a class="btn btn-n" href="login.php" role="button">zaloguj się</a>
            <?php
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
