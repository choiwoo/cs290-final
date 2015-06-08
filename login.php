<?php
include 'secret.php';
include 'data.php';
if (isset($_POST['username'])) {

	$username = $_POST["username"];
	$password = $_POST["password"];
  //connect to database
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "choiwoo-db", $dbpassword, "choiwoo-db");
  if ($mysqli->connect_errno) {
  	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }


	$request = "SELECT count(*) FROM Users WHERE (username=? AND password=?)";
	$stmt = $mysqli->prepare($request);
	$stmt->bind_param('ss', $username, $password);
	$results = dbAccess($stmt, 1);
	if ($results > 0) {
		echo 1;
	}
	else {
		echo 0;
	}
}
?>