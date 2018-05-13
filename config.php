<?
//Connection to the MySQL Server by - tutbuzz.com

define('DB_SERVER', 'localhost'); // Mysql hostname, usually localhost
define('DB_USERNAME', 'root'); // Mysql username
define('DB_PASSWORD', ''); // Mysql password
define('DB_DATABASE', 'todolist'); // Mysql database name


$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysqli_select_db(DB_DATABASE) or die(mysql_error());
?>
