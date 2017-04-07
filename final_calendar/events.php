<?php

include 'formatting.php';

//connects to the database and prints all events in divs
function getEvents() {

  $database = "cal.db";
  $table = "events";

  $field1 = "username";
  $field2 = "event";
  $field3 = "ts";
  $field4 = "id";

  $username = $_COOKIE["current_user"];

  try {$db = new SQLite3($database);}
  catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
  }

  $sql = "SELECT * FROM $table WHERE username='$username'";
  $result = $db->query($sql);

  $events = array(); //an array of timestamps, events, and ids that will be sorted and outputted

  while($record = $result->fetchArray()) {
    $ts = $record[$field3];
    $event = $record[$field2];
    $id = $record[$field4];

    array_push($events, array($ts, $event, $id));
  }

  function compare($a, $b) {
    if ($a[0] == $b[0]) {
        return 0;
    }

    else if ($a[0] < $b[0]) {
      return -1;
    }

    else {
      return 1;
    }
  }

  usort($events, "compare");

  foreach($events as $i) {
    print "<div class='event'>";
    print "<div class='event-time'>" . getDateNotation($i[0]) . " " . getTimeNotation($i[0]) . "</div>";
    print "<div class='event-title'>" . $i[1] . "</div>";
    print "<div class='event-delete' onclick='delete_event(" . $i[2] . ")'>x</div>";
    print "</div>";
  }

}

?>
