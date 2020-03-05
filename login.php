<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="css/register.css" >

  <title>Login</title>
  <style>
   body{
    background-color: lightblue;          
  }
</style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
   <button  class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
     <!-- <span class="sr-only">Toggle navigation</span> -->
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span> 
   </button>
   <span class="navbar-brand" >Lautech cooperative society
   </span>
   <div class="container">
     <div class="navbar-collapse collapse">
       <ul class="nav navbar-nav navbar-right">
         <li class="active"><a href="login.php">home</a></li>  
         <li class="active"><a href="Register.php">Register</a></li>
         <li class="active"><a href="admin.php">Admin</a></li> 
         <li class="active"><a href="dashboard.php">myaccount</a></li> 
       </ul>
     </div>
   </div>
 </nav>
 <br><br><br>
 <div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-body text-center">The cooperative society</div>
      </div>
    </div>
  </div>
</div>
<div class="container"id='cont'>
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <?php 
            session_start();
            if(isset($_SESSION['login_err'])):?>
              <div class="alert alert-danger text-center">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <?php
               foreach ($_SESSION['login_err'] as $key):
                 echo '<h6>'. $key.'</h6>';
               endforeach;?>
             </div>
             <?php
             session_destroy();
           endif;
           ?></div>
         </div>           
         <form role="form" method='<?php echo "POST" ?>' action='<?php echo htmlspecialchars("loginp.php") ?>' >
          <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username or phone no">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          </div>
          <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" value="login" name="submit" >
          </div>
        </form>
        <p class="text-center"><a href="register.php">Register here</a></p>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="thumbnail img-responsive">
        <img src="image/fundcooperative1.jpg" alt="" srcset="">
      </div>
    </div>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <div class="navbar-text pull-right" >
         <p>Copyright Lautech Cooperative Society <?php echo date('Y')?>
         </p>
       </div>
     </div>
   </div>
 </body>
 </html>
 <script src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
 <script src="http://localhost:9090/dashboard/rreal/bootstrap/js/bootstrap.min.js" ></script>
