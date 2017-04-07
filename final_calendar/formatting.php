<?php

  date_default_timezone_set('America/Los_Angeles');

  function getDateNotation($ts) {
    if ($ts > 0) {
      return date("m", $ts) . "/" . date("d", $ts) . "/" . date("Y", $ts);
    }

    else {
      return "-";
    }
  }

  function getTimeNotation($ts) {
    if ($ts > 0) {
      return date("g", $ts) . ":" . date("i", $ts) . date("A", $ts);
    }

    else {
      return "-";
    }
  }

?>
