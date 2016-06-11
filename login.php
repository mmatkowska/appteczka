<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$usirkit = $_SESSION['userkit'];

?>

<!DOCTYPE html>
<html>
<head>

    <title>AppTeczka - zaloguj się</title>
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
    echo "Zalogowałeś się jako <b>$username</b>. <a href='./member.php'>Kliknij tutaj</a> aby przejść do Twojej apteczki.";
} else {
    $form = "<form action='./login.php' method='post'>
        
    <table>

	<tr>
		<td>Nazwa użytkownika:</td>
		<td><input type='text' class='long-txt' name='user' placeholder='Wprowadź nazwę użytkownika' required></td>
	</tr>
	
	<tr>
		<td>Hasło:</td>
		<td><input type='password' class='long-txt' name='password' placeholder='Wprowadź hasło' required></td>
	</tr>

	<tr>
		<td></td>
		<td><input type='submit' class='btn btn-n' name='loginbtn' value='zaloguj się' /></td>
	</tr>
	
	<tr>
		<td></td>
		<td><a href='./register.php'>zarejestruj się</a></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['loginbtn']) {
        $user = $_POST['user'];
        $password = md5($_POST['password']);
       
        if ($user) {
            if ($password) {
                require("connect.php");

                $query = mysql_query("SELECT * FROM users WHERE username='$user'");
                $numrows = mysql_num_rows($query);

                if ($numrows == 1) {
                    $row = mysql_fetch_assoc($query);
                    $dbid = $row['id'];
                    $dbuser = $row['username'];
                    $dbkit = $row['aid_kit_id'];
                    $dbpassword = $row['password'];
                    $dbactive = $row['active'];

                    if ($password == $dbpassword) {

                        if ($dbactive == 1) {
                            $_SESSION['userid'] = $dbid;
                            $_SESSION['username'] = $dbuser;
                            $_SESSION['userkit'] = $dbkit;

                            echo "Zostałeś zalogowany jako <b>$dbuser</b>. <a href ='./member.php'>Kliknij tutaj</a> aby przejść do strony domowej.";
                        } else {
                            echo "Musisz aktywować swoje konto. $form";
                        }
                    } else {
                        echo "Wpisano niepoprawne hasło. $form";
                    }
                } else {
                    echo "Nie znaleziono użytkownika o podanej nazwie. $form";
                }
                mysql_close();
            } else {
                echo "Musisz wpisać swoje hasło. $form";
            }
        } else {
            echo "Musisz wpisać nazwę użytkownika. $form";
        }
    } else {
        echo $form;
    }
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
