#!/usr/local/bin/php
<?php
print '<?xml version = "1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Birthdays</title>
</head>
<body>
  <table border="1">
    <?php
    date_default_timezone_set('America/Los_Angeles');

    $birthyear = 1997;
    $birthmonth = 5;
    $birthday = 5;
    $currentyear = 2017;

    for ($year = $birthyear; $year < $currentyear; $year++) {
      echo "<tr>";
      echo "<td>" . $birthmonth . "/" . $birthday . "/" . $year . "</td>";
      echo "<td>" . date("l", mktime(0, 0, 0, $birthmonth, $birthday, $year)) . "</td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>
