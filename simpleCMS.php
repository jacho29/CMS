<?php
class simpleCMS {
var $host="localhost";
var $username="root";
var $password="";
var $table;

  
public function save($p) {
if ( $_POST['id'] )
$id = mysql_real_escape_string($_POST['id']);
if ( $_POST['title'] )
$title = mysql_real_escape_string($_POST['title']);
if ( $_POST['bodytext'])
$bodytext = mysql_real_escape_string($_POST['bodytext']);
if ( $title && $bodytext ) {
$created = time();
$sql = "INSERT INTO newsDB VALUES('$id','$title','$bodytext','$created')";
return mysql_query($sql);
} else {
return false;
}
}
  
public function update($p) {
if ( $_POST['id'] )
$id = mysql_real_escape_string($_POST['id']);
if ( $_POST['title'] )
$title = mysql_real_escape_string($_POST['title']);
if ( $_POST['bodytext'])
$bodytext = mysql_real_escape_string($_POST['bodytext']);
if ( $title && $bodytext ) {
$created = time();
$sql = "UPDATE newsDB SET `title` = {$_POST['title']}, `bodytext` = {$_POST['bodytext']} WHERE`id` = {$_POST['id']}";
return mysql_query($sql);
} else {
return false;
}
}

public function display_public() {
$q = "SELECT * FROM newsDB ORDER BY created";// limit = opcjonalnie " DESC LIMIT 5";
$r = mysql_query($q);
//jeśli query ok 
if ( $r !== false && mysql_num_rows($r) > 0 ) {
    while ( $a = mysql_fetch_assoc($r) ) {
        
	$title = stripslashes($a['title']);
    $bodytext = stripslashes($a['bodytext']);

    $entry_display .= <<<ENTRY_DISPLAY
	
<div id="post">
<h2>
$title
</h2>
<p>
$bodytext
</p>
<hr />
</div>

ENTRY_DISPLAY;
    }
} else {
$entry_display = <<<ENTRY_DISPLAY

<h2> STRONA NIE ZAWIERA JESZCZE NEWSÓW! </h2>
<p>
Aby dodać, zaloguj się...
</p>

ENTRY_DISPLAY;
}
$entry_display .= <<<ADMIN_OPTION
  
<div id="footer"><center>
<a href="{$_SERVER['PHP_SELF']}?admin=1">Panel Administracyjny</a><br>Stworzone przez Piotr Jaśkiewicz
</center></div>

ADMIN_OPTION;
return $entry_display;
}

public function display_admin() {
session_start();
if (isset($_SESSION['login'])) {
return <<<ADMIN_FORM
	
<form action="{$_SERVER['PHP_SELF']}" method="post">
<label for="id">ID:</label> <br />
<input name="id" id="id" type="text" maxlength="150" /><br />
<label for="title">TYTUŁ:</label> <br />
<input name="title" id="title" type="text" maxlength="150" /><br />
<label for="bodytext">ZAWARTOŚĆ NEWSA:</label><br />
<textarea name="bodytext" placeholder="Pamiętaj Królu o poprawnej polszczyźnie!" id="bodytext"></textarea><br />
<input type="submit" value="DODAJ WPIS" ;/>
</form><br />
<a href="login.php">POWRÓT</a>
<div id="footer"><center>
<a href="{$_SERVER['PHP_SELF']}?admin=1">Panel Administracyjny</a><br>Stworzone przez Piotr Jaśkiewicz
</center></div>

ADMIN_FORM;
} else {
echo 'Nie masz uprawnień administratora, bądź sesja wygasła!';
}
}

public function display_login() {
header('Location: login.php');
}

public function connect() {
mysql_connect($this->host,$this->username,$this->password) or die("Błąd połączenia. " . mysql_error());
mysql_select_db($this->table) or die("Nie ma bazy o takiej nazwie. " . mysql_error());
return $this->buildDB();
}

private function buildDB() {
$sql = <<<MySQL_QUERY
CREATE TABLE IF NOT EXISTS newsDB (
id			VARCHAR(100),
title		VARCHAR(150),
bodytext	TEXT,
created		VARCHAR(100)
)
MySQL_QUERY;
return mysql_query($sql);
}
}
?>
