<html>
<head>
<title>♔Królewski CMS♕</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <div id="tytul"><center>♔ ♕KRÓLEWSKI CMS♕ ♔ </center></div><div id="content">
<?php  
include_once('simpleCMS.php');
$obj = new simpleCMS();
//polaczenie z baza
$obj->host = 'localhost';
$obj->username = 'root';
$obj->password = '';
$obj->table = 'cms';
$obj->connect();
if ( $_POST )
{
$obj->write($_POST);
} 
//switch dla .php?admin=
switch ($_GET['admin']) {
case 1:
    echo $obj->display_login() ;
    break;
case 2:
    echo $obj->display_admin() ;
    break;
default:
	echo $obj->display_public();
	break;
  }
?>
</body>
</html>
