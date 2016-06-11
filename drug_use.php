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

    <title>AppTeczka - zażycie leku</title>
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

  $form = "<form action='./drug_use.php' method='post'>
        
    <table>
	<tr>
		<td>Nazwa leku:</td>
		<td><input type='name' name='name' placeholder='Wprowadż nazwę leku' required></td>
	</tr>
	
	<tr>
		<td>Zażyta ilość:</td>
		<td><input type='number' name='quantity' placeholder='Wprowadź liczbę' required></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type='submit' name='addbtn' value='Prześlij informację o zażyciu leku' /></td>
	</tr>
	
	</table>
</form>";

    if ($_POST['addbtn']) {
         $name=$_POST['name'];
         $quantity=$_POST['quantity'];
         			
    	if($name) {
         	if($quantity) {
         		require("./connect.php");
         		mysql_query("SELECT * FROM drugs_in_kit INNER JOIN drugs_specification ON drugs_in_kit.drugs_specification_id=drugs_specification.id WHERE name_spec LIKE '$name%'");
         		if ($query == true) {
         			$row = mysql_fetch_assoc($query);
                	$dbquantity= $row['quantity_left'];
                	$dbid = $row['id'];
                	$new_quantity = $dbquantity - $quantity;
                	mysql_query("UPDATE drugs_in_kit SET quantity_left='$new_quantity' WHERE id='$dbid' AND aid_kit_id='$userkit'");
                	mysql_query("UPDATE drugs_in_kit SET last_accessed_by='$username' WHERE id='$dbid' AND aid_kit_id='$userkit'");
                	echo "Przesłałeś informację o zażyciu leku. <a href='./member.php'>Powrót do apteczki</a>";
         		} else {
         			echo "Nie znaleziono leku o podanej nazwie. $form";
         		}
         		mysql_close();
         	} else {
         		echo "Wpisz liczbę zażytych tabletek. $form";
         	}
         } else {
         	echo "Wpisz nazwę zażytego leku. $form";
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
