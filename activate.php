<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>
<html>
<head>

    <title>AppTeczka - aktywacja konta</title>
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

$getuser = $_GET['user'];
$getcode = $_GET['code'];


if ($_POST['activatebtn']) {
    $getuser = $_POST['user'];
    $getcode = $_POST['code'];

    if ($getuser) {
        if ($getcode) {
            require("./connect.php");

            $query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
            $numrows = mysql_num_rows($query);

            if ($numrows == 1) {
                $row = mysql_fetch_assoc($query);
                $dbcode = $row['code'];
                $dbactive = $row['active'];

                if ($dbactive == 0) {
                    if ($dbcode == $getcode) {
                        mysql_query("UPDATE users SET active='1' WHERE username='$getuser'");
                        $query = mysql_query("UPDATE users SET active='1' WHERE username='$getuser' AND active='1'");
                        $numrows = mysql_num_rows($query);

                        if ($numrows == 1) {
                            $errormsg = "Twoje konto zostało aktywowane";
                            $getuser = "";
                            $getcode = "";
                        } else {
                            $errormsg = "Wystąpił błąd. Twoje konto nie zostało aktywowane.";
                        }
                    } else {
                        $errormsg = "Wprowadzono niepoprawny kod.";
                    }
                } else {
                    $errormsg = "Twoje konto zostało już aktywowane.";
                }
            } else {
                $errormsg = "Nie znaleziono użytkownika o podanej nazwie.";
            }
        } else {
            $errormsg = "Musisz wprowadzić swój kod aktywacyjny.";
        }
    } else {
        $errormsg = "Musisz wpisać nazwę użytkownika.";
    }
} else

    $errormsg = "";
echo "<form action='./activate.php' method='post'>
	
	<table>
	
	<tr>
		<td></td>
		<td>$errormsg</td>
	</tr>
	
	<tr>
		<td>Nazwa użytkownika:</td>
		<td><input type='text' class='long-txt' name='user' value='$getuser' placeholder='Wprowadź nazwę użytkownika' required></td>
	</tr>
	
	<tr>
		<td>Kod aktywacyjny:</td>
		<td><input type='text' class='long-txt' name='code' value='$getcode' placeholder='Wprowadź kod aktywacyjny' required></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type='submit' class='btn btn-n' name='activatebtn' value='aktywuj' /></td>
	</tr>
	</table>
	
	</form>";

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
