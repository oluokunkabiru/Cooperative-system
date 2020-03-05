<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="css/register.css" >
  <title>Admin</title>
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
   <span class="navbar-brand" >Lautech cooperative society</span>
   <div class="container">
     <div class="navbar-collapse collapse">
       <ul class="nav navbar-nav navbar-right">
         <li class="active"><a href="login.php">Login</a></li>  
         <li class="active"><a href="Register.php">Register</a></li>
         <li class="active"><a href="checktransactions.php">Check Transaction</a></li> 
       </ul>   
     </div>
   </div>
 </nav>
 <br/><br/><br/><br/>
 <div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <br><br><br>
      <div class="panel panel-default">
        <div class="panel-body text-center">
          <img src="image/Cooperative.jpg"style="height: 100px;margin-top: 50px;margin-bottom:45px ">
          <div class="row">
             
            <?php 
            session_start();
            if(isset($_SESSION['err_admin'])):?>
              <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                <?php
                foreach ($_SESSION['err_admin'] as $key):
                  echo '<h6>'. $key.'</h6>';
                endforeach;?>
              </div>
              <?php
              session_destroy();
            endif;
            ?>
          </div>
        </div>           
        <form role="form" method='<?php echo "POST" ?>' action='<?php echo htmlspecialchars("adminp.php") ?>' >
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
      </div>
    </div>
    <div class="col-sm-4">
     
      </div>
    </div>
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