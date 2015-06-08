<?php
include "secret.php";
include "data.php";
if (isset($_POST['jobName'])) {

	$jobName = $_POST['jobName'];
	$descrip = $_POST['description'];
	$jmail = $_POST['email'];
	$locat = $_POST['location'];

  //connect to database
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "choiwoo-db", $dbpassword, "choiwoo-db");
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	echo "DUDE SOMETHING IS FUCKING WRONG AT connect to database";
  }
	$request = "INSERT INTO Job(jobName, description, email, location) VALUES (?, ?, ?, ?)";
	$stmt = $mysqli->prepare($request);
	$stmt->bind_param('ssss', $jobName, $descrip, $jmail, $locat);
	dbAccess($stmt, 0);
	echo 1;
}

?>