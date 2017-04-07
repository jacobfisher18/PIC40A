#!/usr/local/bin/php
<?php

$database = "ajax.db";
$table = "votes";

try {$db = new SQLite3($database);}
catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
}

$yes = 0;
$no = 0;

$sql = "SELECT * FROM $table";
$result = $db->query($sql);

while($record = $result->fetchArray()) {
  $yes = $record["yes"];
  $no = $record["no"];
}

$yes_no = $_GET['vote'];

if ($yes_no == "yes") {
  $yes++;
}

else if ($yes_no == "no") {
  $no++;
}

$query = "UPDATE $table SET yes='$yes', no='$no'";
$result = $db->query($query);

print "$yes,$no";

?>
