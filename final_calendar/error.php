#!/usr/local/bin/php
<?php
print '<?xml version = "1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<title>Error</title>
	<link rel="stylesheet" type="text/css" href="cal.css" />
</head>
<body id="error_body">
	<h1>Error</h1>
	<?php
		$error = $_GET["error"];
		if (!isset($error)) {
			echo "<p>Error with the error page, that's ironic!</p>";
		}

		else if ($error == 1){
			echo "<p>Username exists, but the password was incorrect.</p>";
		}

		else if ($error == 2){
			echo "<p>Username doesn't exist.</p>";
		}

		else if ($error == 3){
			echo "<p>Username taken, please try another.</p>";
		}

		else if ($error == 4){
			echo "<p>At least one form input was invalid.</p>";
		}
	 ?>
</body>
</html>
