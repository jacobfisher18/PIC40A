#!/usr/local/bin/php
<?php

//get data from form
$username = $_POST['username'];
$password = $_POST['password'];

$database = "cal.db";
$table = "users";

try {$db = new SQLite3($database);}
catch (Exception $exception) {
    echo '<p>There was an error connecting to the database!</p>';
    if ($db){echo $exception->getMessage();}
}

$sql = "SELECT * FROM $table";
$result = $db->query($sql);

$all_users = array(); //will hold key value pairs of usernames and passwords

while($record = $result->fetchArray()) {
  $all_users[$record["username"]] = $record["password"];
}

$taken = false; //will be set to true if the given username is taken

//iterate through all users to check if the given username is taken
foreach($all_users as $key => $value){
  if($username == $key) {
    $taken = true;
  }
}

if ($taken) {
  header("Location: http://pic.ucla.edu/~jacobfisher18/final_project/error.php?error=3");
}

else {
  $sql = "INSERT INTO $table (username, password) VALUES ('$username', '$password')";
  $result = $db->query($sql);

  setcookie("current_user", $username, time()+2419200); //cookie that keeps track of login

  header("Location: http://pic.ucla.edu/~jacobfisher18/final_project/cal.php");
}

?>
