#!/usr/local/bin/php
<?php

include 'events.php';

$database = "cal.db";
$table = "events";

$id = $_GET["id"];

try {$db = new SQLite3($database);}
catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
}

//Delete event from the database
$sql = "DELETE FROM $table WHERE id='$id'";
$result = $db->query($sql);

//connects to the database and prints all events in divs
//this will fill the events div in cal.php via AJAX
getEvents();

?>
