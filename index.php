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

    <title>AppTeczka</title>
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
        <div class="row text-center">
            <?php

            if ($username && $userid) {
                /*CHODZI TU O SPR ZALOGOWANIA*/
                ?>
                <h2>Hej, <?php echo "<b>$username</b>"?>! </h2><br>
                    <h3>Mamy nadzieję, że wszystko u Ciebie w porządku i sprawdzasz tylko czy masz plastry. :)</h3>

                <?php
            }
            else {
                ?>
                <h2>AppTeczka</h2>
                <h3>uporządkuj swoje leki</h3>
                <a class="btn btn-n" href="login.php" role="button">zaloguj się</a>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<div class="topWrapper" id="ozdobniki">
    <div class="left">
        <h3>generuj raporty</h3>
        <i class="fa fa-area-chart" style="font-size:78px;color:#759bb6"></i>
    </div>
    <div class="center">
        <h3>monitoruj apteczkę</h3>
        <i class="fa fa-medkit" style="font-size:78px;color:#759bb6"></i>
    </div>
    <div class="right">
        <h3>dbaj o domowników</h3>
        <i class="fa fa-heartbeat" style="font-size:78px;color:#759bb6"></i>
    </div>
</div>

<footer>
    <div class="stopka">
        <p>&copy; BIOMEDIXPOL 2016</p>
        <p>projekt z przedmiotu Systemy Informatyczne w Medycynie</p>
    </div>
</footer>

</body>
</html>