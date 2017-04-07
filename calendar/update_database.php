#!/usr/local/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');

$person = $_POST['person'];
$date = $_POST['date'];
$time = $_POST['time'];
$event_title = $_POST['event_title'];
$event_message = $_POST['event_message'];

//convert time and date to a timestamp
$date_array = explode("-", $date);
$time_array = explode(":", $time);
$ts = mktime($time_array[0], 0, 0, $date_array[0], $date_array[1], $date_array[2]);

/*Write to database*/
$database = "dbjacobfisher18.db";
$table = "event_table";
$field1 = "time";
$field2 = "person";
$field3 = "event_title";
$field4 = "event_message";

try {$db = new SQLite3($database);}
catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
}

$sql = "INSERT INTO $table () VALUES ()";
$sql= "INSERT INTO $table ($field1, $field2,$field3,$field4) VALUES('$ts','$person','$event_title', '$event_message')";
$result = $db->query($sql);
/*-----------------*/

header("Location: http://pic.ucla.edu/~jacobfisher18/calendar2/calendar2.php?");
?>
