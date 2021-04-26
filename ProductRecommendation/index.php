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


  <div class="panel-body">



     <table class="table table-striped">

       <th> Username </th>
       <th> Add Gifts </th>
       <th> Show Gifts </th>
       <th> Show Recommendation </th>


       <?php $result=mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '" . $_SESSION['id'] . "'");



       while ($row=mysqli_fetch_array($result))

      {
       ?>
       <tr>

         <td><h2><b><?php echo $row['username'] ?></h2></b></td>
         <td>
         <form action="add_gifts.php">

           <input type="submit" name="add_gifts" class="btn btn-primary" value="Add Gifts">
           <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

         </form>
        </td>


      <td>
      <form action="show_gifts.php">

        <input type="submit" name="show_gifts" class="btn btn-primary" value="Show Gifts">
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

      </form>
     </td>

     <td>
     <form action="user_recommendation.php">

       <input type="submit" name="show_gifts" class="btn btn-primary" value="Show Recommendation">
       <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

     </form>
    </td>
   </tr>

     <?php } ?>

     </table>

   </div>
