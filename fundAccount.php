<?php session_start();
if(isset($_SESSION['username']) && isset($_SESSION['login'])):?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

  <title>Fund Wallet</title>
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
   <span class="navbar-brand" >SWEP Group 7 cooperative society</span>
   <div class="container">
     <div class="navbar-collapse collapse">
       <ul class="nav navbar-nav navbar-right">
         <li class="active"><a href="dashboard.php">My Account</a></li>
         <li class="active"><a href=".php">Airtime ToCash</a></li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 
          echo $_SESSION['username']; ?>
          <b class="caret"></b>
          <ul class="dropdown-menu">
            <li ><a href="?logout">Logout</a></li>
          </ul>
        </ul>
      </div>

    </div>
  </div>
</nav>
<br><br><br>
<div class="container">
  <div class="row">
   <div class="col-sm-3">

    <img src="image/fund3.jpg"   class="img-responsive">

  </div>

  <div class="col-sm-6">
   <h3 class="text-center ">Fund Account</h3>

   <?php if(isset($_SESSION['err'])):      ?>    
    <div class="alert alert-danger text-center 
    ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php foreach($_SESSION['err'] as $err):
      echo '<h6>'.$err.'</h6>';
    endforeach;?>
  </div>
<?php  endif;
unset($_SESSION['err']);
?>


<form role="form" method='<?php echo "POST" ?>' action='<?php echo htmlspecialchars("fundAccountp.php") ?>' >

  <div class="form-group">
    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount ">
  </div>
  <div class="form-group">
    <input type="number" class="form-control" id="account" name="account" placeholder="Enter account number">
  </div>
  <div class="form-group text-center">
    <input type="submit" class="btn btn-primary"style="width:70%" value="Deposit" name="submit" >
  </form>
</div>
<div class="panel panel-default">
  <div class="panel-body btn-warning text-center ">
    <h6>warning</h6>

  </div>
  <h5 class="text-center">Any money Deposit here cant be refunded but you can place a loan in which the maximum is less than or equal to 2*saving</h5>
</div>

</div>

<div class="col-sm-3">
 <div class="row">
   <div class="thumbnail">
     <img src="image/fund.jpg" class="img-responsive">
   </div>
 </div>
 <div class="row">
  <div class="thumbnail">
    <img src="image/fund1.jpg" class="img-responsive">
  </div>
</div>
<div class="row">
  <div class="thumbnail">
    <img src="image/fund2.jpg" class="img-responsive">
  </div>
</div>
</div>
</div>
</div>
<br><br><br>

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
<?php else :header('location:login.php'); endif;?>

