<?php session_start();
if(isset($_SESSION['login']) && isset($_SESSION['username'])):
  if($_SESSION['username']!=null):



    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

      <title>Loan</title>
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
             <li class="active"><a href="loan.php">Loan out</a></li>
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
      </nav>
      <br><br><br>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h2>My Account
            </h2>
            <div class="panel panel-default">
              <div class="panel-body btn-info text-center
              ">
              <h6>Saving</h6>
              <h4>
                <?php include("database.php");
                $username=$_SESSION['username'];
                echo '#'. amount('registration',$username)['saving'];
                ?></h4>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <h2>Quick action
            </h2>
            <div class="panel panel-default">
              <div class="panel-body btn-info text-center">
                <h4>Quick  action</h4>
              </div>
              <ul class="list-group">
                <li><a class="list-group-item" href="?loan">borrow loan</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <h2>Quick action
            </h2>
            <div class="panel panel-default">
              <div class="panel-body btn-info text-center">
                <h4>Quick  action</h4>
                <ul class="list-group">
                  <li class="list-group-item">
                    <a href="checktransactions.php">Check Transactions History</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <hr>
      <div class='container'>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <div class="">
                <?php 
                if(isset($_SESSION['response'])):?>
                  <div class="row">
                    <div class="alert alert-danger text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <?php
                     foreach ($_SESSION['response'] as $key) :
                      echo '<h6>'.$key.'</h6>';
                    endforeach;?>
                  </div>
                </div> 
                <?php
                unset($_SESSION['response']);
              endif;
              ?>
            </div>
          </div>
          <div class="col-sm-2">
          </div>
          <form action="<?php echo 'loanp.php' ?>" method="post">
            <div class="form-group form-group-sm">
              <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount to borrow">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" id="duration" name="duration" placeholder="how many month do u want to withhold the loan ">
            </div>
            <div class="text-center">
              <input type="submit" class="btn btn-primary"style="width:100%" value="loan money"name="submit" >
            </div>
          </form>
        </div>
        <div class="col-sm-3">
        </div>
      </div>
    </div>
  </div></div>
  <br><br><br>
  <div class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
      <div class="navbar-text pull-right">
       <p>Copyright Lautech Cooperative Society <?php echo date('Y')?>
     </p>
     </div>
   </div>
 </div>
</body>
</html>
<?php endif;
else:header('location:login.php');endif;?>
