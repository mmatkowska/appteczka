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

    <title>AppTeczka - połącz się ze swoją apteczką</title>
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
 $form = "<form action='./connect_to_kit.php' method='post'>
        
    <table>

	<tr>
		<td>Nazwa apteczki:</td>
		<td><input type='text' class='long-txt' name='name' placeholder='Wprowadź nazwę apteczki' required></td>
	</tr>
	
	<tr>
		<td>Hasło:</td>
		<td><input type='password' class='long-txt' name='password' placeholder='Wprowadź hasło do apteczki' required></td>
	</tr>

	<tr>
		<td></td>
		<td><input type='submit' class='btn btn-n' name='connectbtn' value='połącz się' /></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['connectbtn']) {
        $name = $_POST['name'];
        $password = md5($_POST['password']);
       
        if ($name) {
            if ($password) {
                require("connect.php");

                $query = mysql_query("SELECT * FROM aid_kits WHERE kit_name='$name'");
                $numrows = mysql_num_rows($query);

                if ($numrows == 1) {
                    $row = mysql_fetch_assoc($query);
                    $dbid = $row['id'];
                    $dbpassword = $row['kit_password'];
                    if ($password == $dbpassword) {
                            $_SESSION['userkit'] = $dbid;
							mysql_query("UPDATE users SET aid_kit_id='$dbid' WHERE username='$username'");
                            echo "Zostałeś połączony z apteczką $name. <a href='./member.php'>Przejdź do apteczki</a>";
                        
                    } else {
                        echo "Wpisano niepoprawne hasło do apteczki. $form";
                    }
                } else {
                    echo "Nie znaleziono apteczki o podanej nazwie. $form";
                }
                mysql_close();
            } else {
                echo "Musisz wpisać hasło do apteczki. $form";
            }
        } else {
            echo "Musisz wpisać apteczki. $form";
        }
    } else {
        echo $form;
    }
} else {
   echo "Nie jesteś zalogowany. <a href='./member.php'>Zaloguj się</a>";
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
