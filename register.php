<?php

error_reporting(E_ALL ^ E_NOTICE);

?>

    <!DOCTYPE html>
    <html>
    <head>

        <title>AppTeczka - zarejestruj się</title>
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

            if ($_POST['registerbtn']) {
                $getuser = $_POST['user'];
                $getemail = $_POST['email'];
                $getpassword = $_POST['password'];
                $getretypepassword = $_POST['retypepassword'];
				$getrole = $_POST['role'];

                if ($getuser) {
                    if ($getemail) {
                        if ($getpassword) {
                            if ($getretypepassword) {
                                if ($getpassword === $getretypepassword) {
                                    if ((strlen($getemail) >= 7) && (strstr($getemail, "@")) && (strstr($getemail, "."))) {
                                        require("./connect.php");

                                        $query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
                                        $numrows = mysql_num_rows($query);

                                        if ($numrows == 0) {
                                            $query = mysql_query("SELECT * FROM users WHERE email='$getemail'");
                                            $numrows = mysql_num_rows($query);
                                            if ($numrows == 0) {
                                                $date = date("F d, Y");
                                                $code = md5(rand());
                                                $password = md5(md5($password));

                                                mysql_query("INSERT INTO users VALUES ('', '$getuser', '$password', '$getemail', '0', '$code', '$date', '$getrole')");

                                                $query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
                                                $numrows = mysql_num_rows($query);

                                                if ($numrows == 1) {

                                                    $site = "http://student.agh.edu.pl/~mmatkow";
                                                    $webmaster = "mmatkowska <mmatkowska1@gmail.com>";
                                                    $headers = "From: $webmaster";
                                                    $subject = "Domowa apteczka - aktywacja konta.";
                                                    $message = "Dziękuję za zarejestrowanie się. Kliknij w poniższy link aby aktywować swoje konto.\n";
                                                    $message .= "$site/activate.php?user=$getuser&code=$code\n";
                                                    $message .= "Twój kod aktywacyjny: $code\n";
                                                    $message .= "Aby się zalogować należy aktywować swoje konto.";

                                                    if (mail($getemail, $subject, $message, $headers)) {
                                                        $errormsg = "Zostałeś zarejestrowany. Musisz aktywować swoje konto poprzez link aktywacyjny przesłany na adres <b>$getemail</b>.";
                                                        $getuser = "";
                                                        $gemail = "";
                                                    } else {
                                                        $errormsg = "Wystąpił błąd. Twój email aktywacyjny nie został wysłany.";
                                                    }
                                                } else {
                                                    $errormsg = "Wystąpił błąd. Twoje konto nie zostało utworzone.";
                                                }
                                            } else {
                                                $errormsg = "Istnieje już użytkownik o takim adresie email.";
                                            }
                                        } else {
                                            $errormsg = "Istnieje już użytkownik o takiej nazwie.";
                                        }

                                        mysql_close();
                                    } else {
                                        $errormsg = "Musisz wpisać prawidłowy adres email.";
                                    }
                                } else {
                                    $errormsg = "Podane hasła nie są takie same.";
                                }
                            } else {
                                $errormsg = "Musisz potwórzyć swoje hasło aby się zarejestrować.";
                            }
                        } else {
                            $errormsg = "Musisz podać hasło aby się zarejestrować.";
                        }
                    } else {
                        $errormsg = "Musisz podać email aby się zarejestrować.";
                    }
                } else {
                    $errormsg = "Musisz podać nazwę użytkownika aby się zarejestrować.";
                }
            }

            $form = "<form action='./register.php' method='post'>

	<table>
		<tr>
			<td></td>
			<td><font color='red'>$errormsg</font></td>
		</tr>
		
		<tr>
			<td>Nazwa użytkownika:</td>
			<td><input type='text' class='long-txt' name='user' value='$getuser' placeholder='Wprowadź nazwę użytkownika' required></td>
		</tr>
		
		<tr>
			<td>Adres email:</td>
			<td><input type='text' class='long-txt' name='email' value='$getemail' placeholder='Wprowadź adres email' required></td>
		</tr>
		
		<tr>
			<td>Hasło:</td>
			<td><input type='password' class='long-txt' name='password' value='$getpassword' placeholder='Wprowadź hasło' required></td>
		</tr>
		
		<tr>
			<td>Powtórz hasło:</td>
			<td><input type='password' class='long-txt' name='retypepassword' value='$getretypepassword' placeholder='Potwórz hasło' required></td>
		</tr>
		
		<tr>
			<td>Wybierz swoją rolę:</td>
		</tr>
		
		<tr>
			<td><input type='radio' name='role' value='1' required>właściciel</td>
			<td><input type='radio' name='role' value='2'>użytkownik</td>
		</tr>
		
		<tr>
			<td>akceptuję regulamin:</td>
			<td><input type='checkbox' name='regacceptance' value='accept' required></td>
		</tr>
		
			<td></td>
			<td><input type='submit' class='btn btn-n' name='registerbtn' value='zarejestruj się' /></td>
		</tr>
	</table>

</form>";

            echo $form;

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
