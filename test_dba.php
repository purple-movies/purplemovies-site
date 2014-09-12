<?
$user="tester";
$password="testdude1";
$database="testing_dbs";

mysql_connect(localhost, $user, $password);

@mysql_select_db($database) or die( "Unable to select database");

$query="CREATE TABLE contacts (id int(6) NOT NULL auto_increment,first varchar(15) NOT NULL,last varchar(15) NOT NULL,phone varchar(20) NOT NULL,mobile varchar(20) NOT NULL,fax varchar(20) NOT NULL,email varchar(30) NOT NULL,web varchar(30) NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";

mysql_query($query);

$query = "INSERT INTO contacts VALUES ('','John','Smith','01234 567890','00112 334455','01234 567891','johnsmith@gowansnet.com','http://www.gowansnet.com')";

mysql_query($query);




$query="SELECT * FROM contacts";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();

echo "<b><center>Database Output</center></b><br><br>";

$i=0;
while ($i < $num) {

	$first=mysql_result($result,$i,"first");
	$last=mysql_result($result,$i,"last");
	$phone=mysql_result($result,$i,"phone");
	$mobile=mysql_result($result,$i,"mobile");
	$fax=mysql_result($result,$i,"fax");
	$email=mysql_result($result,$i,"email");
	$web=mysql_result($result,$i,"web");

	echo "<b>$first $last</b><br>Phone: $phone<br>Mobile: $mobile<br>Fax: $fax<br>E-mail: $email<br>Web: $web<br><hr><br>";

	$i++;
}



?>