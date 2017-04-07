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
	<link rel="stylesheet" type="text/css" href="cal.css" />
	<script type="text/javascript">

	<!--
	function checkLogin() {
		var username = getCookieValueFor("current_user");

		if (username.length > 0) {
			//user is logged in
			document.getElementById("schedule-title").innerHTML = username + "'s Schedule";
		}

		else {
			//user is not logged in, redirect to home
			window.location = "http://pic.ucla.edu/~jacobfisher18/final_project/home.html";
		}
	}

	function getCookieValueFor(key) {
		var keyvals = document.cookie.split(";");
		var keys = [];
		var vals = [];
		for (var i = 0; i < keyvals.length; i++) {
			var arr = keyvals[i].split("=");
			if (arr[0] == key) {
				return arr[1];
			}
		}

		return "";
	}

	function process_form() {

		document.getElementById("add-event-form").style.display = "none";

		var event_name = document.getElementById("event_name").value;
		var event_date = document.getElementById("event_date").value;
		var event_time = document.getElementById("event_time").value;
		var event_ampm = document.getElementById("event_ampm").value;

		var valid = true; //will be set to false if any inputs are invalid

		//form is invalid if any of these input conditions are met
		if ((event_name.length < 1) || (event_date.length < 8) || (event_date.indexOf("/") == -1) || (event_time.indexOf(":") == -1)) {
			valid = false;
		}

		if (valid) {
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					var result = xhr.responseText;
					display_result(result);
				}
			}

			xhr.open("GET", "http://pic.ucla.edu/~jacobfisher18/final_project/add_event.php?event_name=" + event_name + "&event_date=" + event_date + "&event_time=" + event_time + "&event_ampm=" + event_ampm,true);
			xhr.send(null);
		}

		else {
			window.location = "http://pic.ucla.edu/~jacobfisher18/final_project/error.php?error=4";
		}

	}

	function display_result(result) {
		document.getElementById("events").innerHTML = ""; //clear the current events div
		document.getElementById("events").innerHTML = result; //replace the div with the response text
	}

	function logout() {
		document.cookie = "current_user=;";
		window.location = "http://pic.ucla.edu/~jacobfisher18/final_project/home.html";
	}

	function showForm() {
		document.getElementById("add-event-form").style.display = "block";
	}

	function delete_event(id) {
		//use ajax to delete from events where id=id;

		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var result = xhr.responseText;
				display_result(result);
			}
		}

		xhr.open("GET", "http://pic.ucla.edu/~jacobfisher18/final_project/delete_event.php?id=" + id,true);
		xhr.send(null);
	}

	-->
	</script>
</head>
<body onload="checkLogin()">

	<div id="header">
		<h1 id="schedule-title">Schedule</h1>
		<div id="logout" onclick="logout()">Log Out</div>
	</div>

	<div id='events'>
	<?php
	include 'events.php';
	getEvents(); //connects to the database and prints all events
	?>
	</div>

	<div id="add-event-button" onclick="showForm()">+ Add Event</div>

	<form id="add-event-form" action="" method="post" onsubmit="process_form(); return false;">
		<fieldset>
			<label>Event: </label>
			<input value="Soccer Practice" type="text" name="event_name" id="event_name"/>
			<label>Date: </label>
			<input value="05/05/2017" type="text" name="event_date" id="event_date"/>
			<label>Time: </label>
			<input value="3:30" type="text" name="event_time" id="event_time"/>
			<select name="event_ampm" id="event_ampm">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select>
			<input type="button" id="event_submit" value="Submit" onclick="process_form()"/>
		</fieldset>
	</form>

</body>
</html>
