
<?php
/* delete a todo or list of todos once they 'done'  */
$taskid = $_GET[taskid];

 $callback = '';
    if (isset($_GET['callback']))
    {
        $callback = filter_var($_GET['callback'], FILTER_SANITIZE_STRING);
    }


$dbh=mysql_connect ("localhost", "sonyainc_cooper","cooper") or die('Cannot connect to the database because: ' . mysql_error());
mysql_select_db ("sonyainc_testDB");
$table_id = "proto_mainnav";

$query = "DELETE FROM $table_id WHERE nav_id = $taskid;";


$result = mysql_query($query, $dbh)  or die('Cannot run query because: ' . mysql_error());

echo $callback .'{status:'. $result.'};';

mysql_free_result($result); 

?>
