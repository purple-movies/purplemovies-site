<?
//include("db_info.php"); // File containing DB name and user access info for this web address.
$user_name      = $_POST[ 'user_name' ];
$password       = $_POST[ 'password' ];
$database       = $_POST[ 'database' ];
    
$input_query    = $_POST[ 'input_query' ];      // Get query for putting stuff in DB.
$output_query   = $_POST[ 'output_query' ];     // Get query for stuff we want returned.

echo $user_name, $password;
mysql_connect(localhost, $user_name, $password);                        // Connect to dbs.
@mysql_select_db($database) or die( "Unable to select database...");       // Select db on system.


//CREATE TABLE s2s_scores ( id int(6) NOT NULL auto_increment, name varchar(15) )

if($input_query){
    echo '   table  ', $input_query;
    mysql_query($input_query);             // Run query to input stuff to DB.
}

if($output_query){

    echo '   stuff in query 2   ';
    
    $output_result = mysql_query($output_query);        // Get results of output query.
    
    echo 'result ', $output_result;
    
    $length = mysql_numrows($output_result);            // Get length of table

    mysql_close();

    echo "<data>";
    //echo "<", $table_name, ">";

    $i=0;
    while ($i < $length){

            echo mysql_result($output_result, $i, "*");

            // $first=mysql_result($result,$i,"first");
            // $last=mysql_result($result,$i,"last");
            // $phone=mysql_result($result,$i,"phone");
            // $mobile=mysql_result($result,$i,"mobile");
            // $fax=mysql_result($result,$i,"fax");
            // $email=mysql_result($result,$i,"email");
            // $web=mysql_result($result,$i,"web");

            // echo "<b>$first $last</b><br>Phone: $phone<br>Mobile: $mobile<br>Fax: $fax<br>E-mail: $email<br>Web: $web<br><hr><br>";

            $i++;
    }

    echo "</", $table_name, ">";
    echo "</data>";

}else{
    mysql_close();
}
?>