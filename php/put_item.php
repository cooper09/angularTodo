
<?php

$task = $_GET[task];

 $callback = '';
    if (isset($_GET['callback']))
    {
        $callback = filter_var($_GET['callback'], FILTER_SANITIZE_STRING);
    }

$resultArr = array();
$resultArr = "hey stinky!!";

$dbh=mysql_connect ("localhost", "sonyainc_cooper","cooper") or die('Cannot connect to the database because: ' . mysql_error());
mysql_select_db ("sonyainc_testDB");
$table_id = "proto_mainnav";

$query = "INSERT INTO proto_mainnav (nav_txt )  VALUES ('$task');";

	$result = mysql_query($query, $dbh)  or die('Cannot run query because: ' . mysql_error());
    echo $callback .'{tasks:'. json_encode($resultArr).'};';  

    mysql_free_result($result); 

?>
