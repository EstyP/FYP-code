
<!doctype html>

<html lang="en">
	<head>
	  <meta charset="utf-8">

	  <title>AI Recommendation System</title>
	  <meta name="description" content="The HTML5 Herald">
	  <meta name="author" content="SitePoint">

	  <!---Fonts-->

	  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


	  <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.css">

	  <!--- Overrides -->
	  <link rel="stylesheet" href="css/style.css">

	  <!--[if lt IE 9]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	  <![endif]-->
	</head>

	<body style="background-color:white;text-align:center">


	<div class="container">
		<div class="row margin-top-30">
			<div class="col-lg-12">
			 	<a href="index.html">
					<img src="img/logo.png" class="img-center">
				</a>
			</div>
		</div>
	</div>

		<div class="container">
		<div class="row margin-top-30">
			<div class="col-lg-12">
				<h2 class="text-center">Artificial Intelligence</h2>
			</div>
		</div>
	</div>


	<nav class="navbar navbar-default margin-top-30" style="background-color:white">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 text-center">
      <ul class="nav navbar-nav text-center">
            <li class="navbar-menu" ><a href="index.html">Return to previous page <span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "password";
	$mysql_database = "userdata";

	$u_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_email = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
	$u_text = filter_var($_POST["user_text"], FILTER_SANITIZE_STRING);

	if (empty($u_name)){
		die("Please enter your name");
	}
	if (empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address");
	}

	if (empty($u_text)){
		die("Please enter text");
	}



	//Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$statement = $mysqli->prepare("INSERT INTO users_data (user_name, user_email, user_message) VALUES(?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sss', $u_name, $u_email, $u_text); //bind values and execute insert query

	if($statement->execute()){
		print "Hello " . $u_name . "!, your message has been saved!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>

<ul class="container-fluid margin-top-50 margin-bottom-50" style="padding:5px; background-color:black"">  </ul>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
