<?php

  session_start();
  if(isset($_GET['id']))
  {
    $_SESSION['id']=$_GET['id'];
  }

  include("header.php");
  include("database.php");

    $flag=0;

    if(isset($_POST['submit']))
    {
      $result=mysqli_query($con, "insert into user_gifts(user_id,gift_name,gift_rating)values('$_SESSION[id]','$_POST[gift_name]','$_POST[gift_rating]')");
      if($result)
      {
        $flag=1;
      }
    }

?>



  <?php if($flag) { ?>

    <div class="alert alert-success"> Gift Successfully Added</div>

  <?php } ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>

      <title>Add Gifts</title>

  </head>
  <body>
  </br>
      <h3 class="text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Please add some gifts to your list so we can generate accurate recommendations.</h3>
    </br>

  </body>
  </html>

  <div class="panel-body">

    <form action="add_gifts.php" method="post">

      <div class="form-group">
        <label for="username"> Gift Name </label>
        <input type="text" name="gift_name" id="gift_name" class="form-control" required>

      </div>

      <div class="form-group">
        <label for="username"> Rating 1-5 </label>
        <input type="number" name="gift_rating" id="gift_rating" class="form-control" required>

      </div>

      <div class="form-group">
        <input type="submit" name="submit" value="submit" class="btn btn-primary" required>

          <a class="btn btn-info pull-right" href="index.php"> Cancel </a>

      </div>

    </div>



    </form>
