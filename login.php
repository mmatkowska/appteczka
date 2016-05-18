<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>

	<title>AppTeczka - zaloguj się</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="mine_main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>

</head>
<body>

<header class="container">
		<div class="row">
			<h1 class="col-sm-4">AppTeczka</h1>
			<nav class="col-sm-8">
				<a class="btn btn-primary" href="index.php" role="button">strona domowa</a>
				<a class="btn btn-primary" href="member.php" role="button">Twoja domowa apteczka</a>
				<a class="btn btn-primary" href="statistics.php" role="button">statystyki</a>
				<a class="btn btn-primary" href="documentation.php" role="button">dokumentacja</a>
				<a class="btn btn-primary" href="logout.php" role="button">wyloguj się</a>
			</nav>
		</div>
	</header>

<?php

if ($username && $userid) {
    echo "Zalogowałeś się jako <b>$username</b>. <a href='./member.php'>Kliknij tutaj</a> aby przejść do strony domowej.";
} else {
    $form = "<form action='./login.php' method='post'>
        
    <table>

	<tr>
		<td>Nazwa użytkownika:</td>
		<td><input type='text' name='user' placeholder='Wprowadź nazwę użytkownika' required></td>
	</tr>
	
	<tr>
		<td>Hasło:</td>
		<td><input type='password' name='password' placeholder='Wprowadź hasło' required></td>
	</tr>

	<tr>
		<td></td>
		<td><input type='submit' name='loginbtn' value='Zaloguj się' /></td>
	</tr>
	
	<tr>
		<td></td>
		<td><a href='./register.php'>Zarejestruj się</a></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['loginbtn']) {
        $user = $_POST['user'];
		$password = md5($password);
        $password = $_POST['password'];

        if ($user) {
            if ($password) {
                require("connect.php");

                $query = mysql_query("SELECT * FROM users WHERE username='$user'");
                $numrows = mysql_num_rows($query);

                if ($numrows == 1) {
                    $row = mysql_fetch_assoc($query);
                    $dbid = $row['id'];
                    $dbuser = $row['username'];
                    $dbpassword = $row['password'];
                    $dbactive = $row['active'];

                    if ($password == $dbpassword) {

                        if ($dbactive == 1) {
                            $_SESSION['userid'] = $dbid;
                            $_SESSION['username'] = $dbuser;

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

<footer>
	<div class="container">
			<p>&copy; BIOMEDIXPOL</p>
	</div>
</footer>

</body>
</html>