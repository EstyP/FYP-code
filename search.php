
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
            <li class="navbar-menu" ><a href="search.html">Return to previous page <span class="sr-only">(current)</span></a></li>f
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php

$anniversary = $_POST['anniversary'];
$gifttype = $_POST['gifttype'];
$MF = $_POST['MF'];


$servername = "localhost";
$username = "root";
$password = "password";
$db = "giftdata";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

$sql = "select * from gifts_data
									WHERE years_married like '%$anniversary%'
									AND giftstyle like '%$gifttype%'
									AND M_F like '%$MF%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["giftname"]."<br>";
}
} else {
	echo "0 records";
}

$conn->close();

?>


<ul class="container-fluid margin-top-50 margin-bottom-50" style="padding:5px; background-color:black"">  </ul>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
