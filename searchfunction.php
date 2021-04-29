<?php

include("header.php");
include("database.php");

 // Initialize the session
 session_start();

 // Check if the user is logged in, if not then redirect to login page
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: login.php");
     exit;
 }
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>

     <title>Welcome</title>

 </head>
 <body>
 </br>
     <h1 class="text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
   </br>

 </body>
 </html>


<div class="container text-left form-style-5">
  <h4><b>Find your perfect gift using the search bars below!</h4></b><br/>


<form action="search.php" method="post">
Anniversary Year
<input type="number" name="anniversary"><br>
Gift Style
<select name="gifttype">
 <option value="Modern">Modern</option>
    <option value="Traditional">Traditional</option>
</select>
Masculine or Feminine <select name="MF">
 <option value="Masculine">Masculine</option>
    <option value="Feminine">Feminine</option>
</select>
<br>
<input type ="submit">
</form>
