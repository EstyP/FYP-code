<?php

include("database.php");
include("recommend.php");
include("header.php");
session_start();


$gifts=mysqli_query($con,"select * from user_gifts");

$matrix=array();

while($gift=mysqli_fetch_array($gifts))
{
  $users=mysqli_query($con,"select username from users where id=$gift[user_id]");
  $username=mysqli_fetch_array($users);

  $matrix[$username['username']][$gift['gift_name']]=$gift['gift_rating'];
}

$users=mysqli_query($con,"select username from users where id=$_GET[id]");
$username=mysqli_fetch_array($users);

 ?>


  <!DOCTYPE html>
  <html lang="en">
  <head>

      <title>Recommendation</title>

  </head>
  <body>
  </br>
      <h1 class="text-center"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>'s list of recommendations</h1>
    </br>

  </body>
  </html>







     <table class="table table-striped">

       <th> Gift Name </th>
       <th> Gift Rating </th>


       <?php
       $recommendation=array();

       $recommendation=getRecommendation($matrix,$username['username']);

       foreach($recommendation as $gift=>$rating)
       {

       ?>
       <tr>
         <td><?php echo $gift; ?></td>
         <td><?php echo $rating; ?></td>

   </tr>

 <?php } ?>

     </table>



 <div class="form-group">

     <a class="btn btn-info pull-right" href="index.php"> Back </a>

 </div>
