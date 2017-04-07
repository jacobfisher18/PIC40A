#!/usr/local/bin/php
<?php

include 'events.php';

$username = $_COOKIE["current_user"];

$event_name = $_GET["event_name"];
$event_date = $_GET["event_date"];
$event_time = $_GET["event_time"];
$event_ampm = $_GET["event_ampm"];

$hour = explode(":", $event_time)[0];
$minute = explode(":", $event_time)[1];
$month = explode("/", $event_date)[0];
$day = explode("/", $event_date)[1];
$year = explode("/", $event_date)[2];

$hour_adjusted = $hour;
if ($event_ampm == "PM") {
  $hour_adjusted += 12;
}

$ts = mktime($hour_adjusted, $minute, 0, $month, $day, $year);

$database = "cal.db";
$table = "events";

$field1 = "username";
$field2 = "event";
$field3 = "ts";

try {$db = new SQLite3($database);}
catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
}

//Insert form data into the database
$sql = "INSERT INTO $table ($field1,$field2,$field3) VALUES ('$username','$event_name','$ts')";
$result = $db->query($sql);

//connects to the database and prints all events in divs
//this will fill the events div in cal.php via AJAX
getEvents();

?>
