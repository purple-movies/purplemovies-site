<?
$user="tester";
$password="testdude1";
$database="testing_dbs";

mysql_connect(localhost, $user, $password);

@mysql_select_db($database) or die( "Unable to select database");

$query="DROP TABLE contacts";

mysql_query($query);

echo 'It\'s dead!';
?>