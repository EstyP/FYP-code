<?php

include("header.php");
include("database.php");

session_start();

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>

     <title>Gifts</title>

 </head>
 <body>
 </br>
     <h1 class="text-center"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>'s list of gifts</h1>
   </br>

 </body>
 </html>


     <table class="table table-striped">

       <th> Gift Name </th>
       <th> Gift Rating </th>


       <?php $result=mysqli_query($con,"select * from user_gifts where user_id='$_GET[id]'");

       while ($row=mysqli_fetch_array($result))

      {
       ?>
       <tr>
         <td><?php echo $row['gift_name'] ?></td>
         <td><?php echo $row['gift_rating'] ?></td>

   </tr>

     <?php } ?>

     </table>




 <div class="footer">
   <h2>

     <a class="btn btn-info pull-right" href="index.php"> Back </a>

   </h2>
 </div>
