<html>
<head>
<title>Edytuj zawartość newsa</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="tytul"><center>KRÓLEWSKI CMS</center></div><div id="content">
<?php
include_once('simpleCMS.php');
$obj = new simpleCMS();
Połączenie z bazą
$obj->host = 'localhost';
$obj->username = 'root';
$obj->password = '';
$obj->table = 'cms';
$obj->connect();
if ( $_POST )
$obj->update($_POST);
?>
<form action="edit.php" method="post">
<label for="id">ID:</label><br />
<input name="id" id="id" type="text" maxlength="150" />
<div class="clear"></div>
<label for="title">TYTUŁ:</label><br />
<input name="title" id="title" type="text" maxlength="150" />
<div class="clear"></div>
<label for="bodytext">ZAWARTOŚĆ NEWSA:</label><br />
<textarea name="bodytext" id="bodytext"></textarea>
<div class="clear"></div>
<input type="submit" value="UAKTUALNIJ WPIS" ;/>
</form><br />
<a href="login.php">POWRÓT</a>
<div id="footer"><center>
<a href="index.php?admin=1">Panel Administracyjny</a><br>Stworzone przez Piotr Jaśkiewicz
</center></div>
</body>
</html>
