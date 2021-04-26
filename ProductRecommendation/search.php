<?php
include("header.php");
include("database.php");
include("backend_search.php");
session_start();
?>

</head>
<body>
</br>
    <h1 class="text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Your perfect gift is a <b>


</body>
</html>

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

</br>
</br>
<h1> Already bought this gift? <a href="add_gifts.php">Click here</a> to add it to your rated items to improve your recommendations! </h1>
