<?php
  error_reporting(E_ALL);
  ini_set('display errors',1);
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Woo's Final</title>
  <link href = "bootstrap.min.css" rel = "stylesheet">
  <script src="ajax.js"></script>
  <script src="login.js"></script>
  </head>
<body>
  <div class = "container">
    <div class="jumbotron text-center">
      <h1>Super Exclusive Job Board</h1>
      <br><br>
	  <h3>Member Exclusive Jobs</h3>
	  <br><br>
      <center>
      <table>
  	    <tbody>
  		  <tr>
  		    <td class="inner">Username:
  			  <input id="username" class="form-control" type="text">
  			  <br>
  			  Password:
  			  <input id="password" class="form-control" type="password">
  			  <br>
  			  <input onclick="login('login')" class="btn btn-success btn-block" type="submit" value="Login">
  			  <input onclick="login('new')" class="btn btn-success btn-block" type="button" value="Create Account">
  			</td>
  		  </tr>
  		</tbody>
  	  </table>
      <div id="statusUpdate"></div>
      </center>
    </div>
  </div>

  <div class = "navbar navbar-default navbar-fixed-bottom">
    <div class = "container">
      <p class = "navbar-text pull-right">Brought to you by Woo Choi</p>
  </div>
</body>
</html>
