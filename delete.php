<html>
<head>
<title>Usuń całkowicie newsa</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="tytul"><center>KRÓLEWSKI CMS</center></div><div id="content">
<?php
include_once('simpleCMS.php');//miałem problem z wykorzystaniem connecta z klasy simpleCMS, postanowiłem manualnie podejść do problemu
if(isset($_POST['delete'])) {
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname='cms';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
$news_id = $_POST['news_id'];
$sql = "DELETE FROM newsDB ". "WHERE id = $news_id" ;
mysql_select_db('cms');
$cont = mysql_query( $sql, $conn );
if(! $cont ) {
die('Nie udało się usunąć : ' . mysql_error());
}
echo "News został usunięty prawidłowo!\n";?><br><a href="login.php">Powrót na zamek</a><?php
mysql_close($conn);
} else {
?>
<form method = "post" action = "<?php $_PHP_SELF ?>">
<table width = "400" border = "0" cellspacing = "1" cellpadding = "2">
<tr>
<td width = "100">NEWS ID</td>
<td><input name = "news_id" type = "text" id = "news_id"></td>
</tr>
<tr>
<td width = "100"> </td>
<td> </td>
</tr>
<tr>
<td width = "100"> </td>
<td>
<input name = "delete" type = "submit" id = "delete" value = "Wymaż">
</td>
</tr>
</table>
</form>
<a href="login.php">POWRÓT</a>
<?php
}
?>
<div id="footer"><center>
<a href="index.php?admin=1">Panel Administracyjny</a><br>Stworzone przez Piotr Jaśkiewicz
</center></div>
</body>
</html>
