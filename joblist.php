<?php
	if(isset($_SESSION['name'])) {
		$user = $_SESSION['name'];
	}
include 'secret.php';
include 'data.php';

  //connect to database
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "choiwoo-db", $dbpassword, "choiwoo-db");
  if ($mysqli->connect_errno) {
  	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Super Exclusive Jobs!</title>
    <link href = "bootstrap.min.css" rel = "stylesheet">
	<script src="ajax.js"></script>
	<script src="login.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

          <a class="navbar-brand" href="joblist.php">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

          <ul class="nav navbar-nav">
            <li><a href="https://www.indeed.com">INDEED</a></li>
            <li><a href="https://angel.co/">ANGELLIST</a></li>
			<li><a href="https://news.ycombinator.com/jobs">YCOMB</a></li>
            <li><a href="main.php">LOG OUT</a></li>
          </ul>
        </div><!-- /.container-fluid -->
    </nav>
    <div class = "container">
      <div class="jumbotron text-center">
      <h1>Super Exclusive Job Board</h1>
      <br><br>
	  <h3>You can post jobs for fellow members</h3>
	  <h3>You can apply to posted jobs via Email</h3>
	  <h3>Only I have the power to delete jobs from the board</h3>
      </div>
    </div>
	<div class= "container">	

	    <fieldset>
            <legend>Add a Job</legend>
			<center>
			<table>
				<tbody>
				<tr><td class="inner">
					Job Title: <input type='text' id="jobName" class="form-control"/><br>			
					Description: <input type='text' id="description" class="form-control"/><br>
					Email: <input type='text' id="email" class="form-control"/><br>
					Location: <input type='text' id="location" class="form-control"/><br>
					<input onclick="addJob()" class="btn btn-success btn-block" type="submit" value="Add Job">
					<button name='deleteAll' value='deleteAllJobs' class="btn btn-success btn-block">Delete All Jobs</button>		 
				</td></tr></tbody>
			</table>
			<center>
        </fieldset>
		
        <br>
		<div id="statusUpdate"></div>				
		<fieldset>
            <legend>Job List</legend>
		<?php displayTable($mysqli); ?>
		</fieldset>
	</div>
	</body>
</html>
<?php

/*displayTable Function
displays table.
input: $mysqli database
output: table of the database from $mysqli
*/
function displayTable(&$mysqli) {
    if (!mysqli_num_rows($mysqli->query("SELECT id FROM Job"))) {
        return;
    }
    $stmt = NULL;
    $stmt = $mysqli->prepare("SELECT jobName, description, email, location FROM Job");
    if (!$stmt->execute()) {
        echo 'Query failed: (' . $mysqli->errno . ') ' . $mysqli->error . '<br>';
        return;
    }
    
    $jName = NULL;
    $jDes = NULL;
    $jMail = NULL;
    $jLoc = NULL;
    
    if (!$stmt->bind_result($jName, $jDes, $jMail, $jLoc)) {
        echo 'Binding output parameters failed: (' . $stmt->errno . ') ' . $stmt->error . '<br>';
        return;
    }
    
    echo '<table border="2" width=100% class="table table-bordered table-striped">
			<tr><td><b>Job Title</b></font>
            </td><td><b>Description</b></td>
            <td><b>Email</b></td><td><b>Location</b></td>
            </tr>';
    
	//fetching  data
    while ($stmt->fetch()) {
        echo "<tr><td>$jName</td><td>$jDes</td>
            <td>$jMail</td><td>$jLoc</td>";
        // need to prevent the string from being separated by a space in $_POST['vidName']
        $jName = str_replace(' ', '_', $jName);
    }
    echo '</tr></table><br>';
}
?>