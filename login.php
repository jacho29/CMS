<html>
<head>
<title>Zaloguj/Administruj</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<div id="tytul"><center>KRÓLEWSKI CMS</center></div><div id="content">
<?php
session_start();
//ustawienia administratora(login i hasło)
$username = 'admin';
$password = 'root';
$random1 = 'bardzo_trudny_klucz_1';
$random2 = 'bardzo_trudny_klucz_2';
//użycie funkcji skrótu
$hash = md5($random1.$pass.$random2); 
$self = $_SERVER['REQUEST_URI'];
//wylogowywanie
if(isset($_GET['logout'])){
unset($_SESSION['login']);
}
//pelny dostep, jeśli sesja isset
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {
?>
<body>
<p>Witam Królu Złoty!<br>Obecny użytkownik: <?php echo $username; ?><br>Co pragniesz począć, Panie?</p><br><ul>
<li><a href="index.php?admin=2">Dodaj legende</a></li>
<li><a href="edit.php">Dokonaj zmian w legendzie</a></li>
<li><a href="index.php">Przeglądaj doczesne historie</a></li>
<li><a href="delete.php">Wymaż kartę historii</a></li>
<li><a href="?logout=true">Opuść zamek</a></li>
</ul>	
<?php
}
// przy okejce, jeśli !sesjaisset
else if (isset($_POST['submit'])) {
if ($_POST['username'] == $username && $_POST['password'] == $password){
$_SESSION["login"] = $hash;
header("Location: $_SERVER[PHP_SELF]");
} else {
display_login_form();
echo '<p>Błędny login lub hasło!</p>';
}
}	
//reszta, pokaz forme login
else { 
display_login_form();
}
function display_login_form(){ ?>
<form action="<?php echo $self; ?>" method='post'>
<label for="username">Login    </label>
<input type="text" name="username" id="username"><br><br>
<label for="password">Hasło    </label>
<input type="password" name="password" id="password"><br><br>
<input type="submit" name="submit" value="Dalej"><br><a href="index.php">Trafiłeś tu przez przypadek?</a>
</form>	
<?php } ?>
<div id="footer"><center>
<a href="index.php?admin=1">Panel Administracyjny</a><br>Stworzone przez Piotr Jaśkiewicz
</center></div>
</body>
