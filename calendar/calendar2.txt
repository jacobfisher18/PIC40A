#!/usr/local/bin/php
<?php
print '<?xml version = "1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <title>Calendar</title>
  <link rel="stylesheet" type="text/css" href="calendar.css" />
</head>
<body>
  <div class="container">
    <h1>Bruin Family Schedule for
      <?php
      date_default_timezone_set('America/Los_Angeles');

      $passed_ts = $_GET["time_stamp"];

      if (isset($passed_ts)) {
        $ts = $passed_ts;
      }

      else {
        $ts = time();
      }

      $day = date("D", $ts);
      $month = date("F", $ts);
      $date = date("j", $ts);
      $year = date("Y", $ts);
      $hour = date("g", $ts);
      $minute = date("i", $ts);
      $AMPM = date("A", $ts);

      echo "$day, $month $date, $year, $hour:$minute $AMPM";
      ?>
    </h1>
    <table id="event_table">
      <tr>
        <th class='hr_td_'> &nbsp; </th> <th class='table_header'>Joe</th><th class='table_header'>Joanna</th><th class='table_header'>Lil Cub</th>
      </tr>

      <?php

      function get_hour_string($ts) {
        $hour = date("g", $ts);
        $AMPM = date("A", $ts);
        return "$hour:00$AMPM";
      }

      function get_events($person, $ts) {
        $database = "dbjacobfisher18.db";
        $table = "event_table";

        try {$db = new SQLite3($database);}
        catch (Exception $exception) {
            echo '<p>There was an error connecting to the database!</p>';
            if ($db){echo $exception->getMessage();}
        }

        $sql = "SELECT * FROM $table WHERE person = '$person' AND time = '$ts'";
        $result = $db->query($sql);

        $result_string = "";

        while($record = $result->fetchArray()) {
          $result_string = $result_string . $record["event_title"] . ": " . $record["event_message"];
        }

        return $result_string;
      }

      $hours_to_show = 12;

      $endts = $ts + ($hours_to_show * 3600);

      for ($i = $ts; $i < $endts; $i+=3600) {
        $hour = date("g", $i);

        echo "<tr class=";
        if ($hour % 2 == 0) { echo "'even_row'>";}
        else { echo "'odd_row'>";}

        /*floor the i timestamp to the hour*/
        $floored_i = floor($i/3600)*3600;

        echo "<td class='hr_td'>" . get_hour_string($i) . "</td>";
        echo "<td>" . get_events("Joe", $floored_i) . "</td>";
        echo "<td>" . get_events("Joanna", $floored_i) . "</td>";
        echo "<td>" . get_events("Cub", $floored_i) . "</td>";
        echo "</tr>";
      }
      ?>
    </table>

    <form id="prev" method="get" action="calendar2.php">
      <p>
        <input type="hidden" name="time_stamp" value="<?php echo ($ts - 43200);?>"/>
        <input type="submit" value="Previous twelve hours"/>
      </p>
    </form>

    <form id="next" method="get" action="calendar2.php">
      <p>
        <input type="hidden" name="time_stamp" value="<?php echo ($ts + 43200); ?>"/>
        <input type="submit" value="Next twelve hours"/>
      </p>
    </form>

    <form id="today" method="get" action="calendar2.php">
      <p>
        <input type="submit" value="Today"/>
      </p>
    </form>
  </div>
</body>
</html>
