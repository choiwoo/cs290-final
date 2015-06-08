<?php
include "secret.php";
include "data.php";
if (isset($_POST['username'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

  //connect to database
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "choiwoo-db", $dbpassword, "choiwoo-db");
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	echo "DUDE SOMETHING IS FUCKING WRONG AT connect to database";
  }


	$request = "SELECT count(*) FROM Users WHERE username = ?";
	$stmt = $mysqli->prepare($request);
	$stmt->bind_param('s', $username);
	$results = dbAccess($stmt, 1);

	if ($results > 0) {
		echo 0;
	}
	else {
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "choiwoo-db", $dbpassword, "choiwoo-db");
		$request = "INSERT INTO Users(username, password) VALUES (?, ?)";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('ss', $username, $password);
		dbAccess($stmt, 0);
		echo 1;
	}
}
?>
