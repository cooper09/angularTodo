
<?php

 $callback = '';
    if (isset($_GET['callback']))
    {
        $callback = filter_var($_GET['callback'], FILTER_SANITIZE_STRING);
    }

$resultArr = array();
$i = 0;
class task
{
	public $id = "000";
    public $task = "I'm a gonna git you!";
    public $done = "done";

    function do_task()
    {
        echo "Doing task."; 
    }
}

$dbh=mysql_connect ("localhost", "sonyainc_cooper","cooper") or die('Cannot connect to the database because: ' . mysql_error());
mysql_select_db ("sonyainc_testDB");

$table_id = "proto_mainnav";
	$query = "SELECT * FROM " . $table_id ;

	$result = mysql_query($query, $dbh);
	$num_rows = mysql_num_rows($result);

	if (!$result) {
		$flashString = 'queryError=file not found';
	}else{
		if($num_rows == 0){
			$flashString = 'queryError=file not found';
		}else{
			while ($row = mysql_fetch_assoc($result)) {
				$flashString .= 'navItem' . $row['nav_id'] . '=' . $row['nav_txt']."<br>";
				$i++;

				$Obj = new task();
				$Obj->id = $row['nav_id'];
				$Obj->task = $row['nav_txt'];

				array_push($resultArr, $Obj); 
			}
		}
	}

	 // make an array with some random values.. so you would see that the results are fetched each time you call this script
   
	// create an array of objects 

    $array = array( 'tasks' =>
    			array (
                    'id' => rand(1,13),
                    'task' => "remote data json",
                    'done' => false
                     ),
    			array (
    				'id' => rand(1,13),
                    'task' => "second item on the list",
                    'done' => true
    				),
    			array (
    				'id' => rand(1,13),
                    'task' => "to go where no man has gone before...",
                    'done' => false
    				)
    );

    	mysql_free_result($result);

    // output this array json encoded.. the callback function being the padding (a function available in the web page)
 //   echo $callback . '('.json_encode($array).');';
  //  	echo "final result: ".$resultArr ;
   	echo $callback . '('.json_encode($resultArr).');';

?>
