<?php  session_start(); if(isset($_SESSION['login_admin'])):
if(isset($_GET['save']))
{
   $_SESSION['admin']='save';
   header('location:moneysave.php');   
}
if (isset($_GET['logout']))
{
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

    <title>Check</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">

            <button  class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <span class="navbar-brand" >SWEP Group 7 cooperative society</span>
            <div class="container">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="login.php">User Login</a></li>
                        <li class="active"><a href="register.php">Register</a></li>
                        <li ><a style="color:red"  href="?logout">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <div class='container'>
            <div class='row'>
                <div class="col-sm-4">
                    <h2>Quick action</h2>
                    <div class="panel panel-default">
                        <div class="panel-body btn-info text-center">
                            <h4>Quick  action</h4>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="?save">Approve Payment and Calculated Interest</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h2>Quick action</h2>
                    <div class="panel panel-default">
                        <div class="panel-body btn-info text-center">
                            <h4>Overall Estimation</h4>
                        </div>
                        <ul class="">
                            <?php 
                            include('database.php');
                            $loan_received=admin('loan','loan_received');
                            $loan_borrowed=admin('loan','loan_borrowed');
                            $loan_paid_WITH_interest=admin('loan','loan_paid_WITH_interest');
                            $expected_loan_WITH_interest=admin('loan','loan_WITH_interest');
                            $lended=$loan_borrowed-$loan_received;
                            $interest_recieved=$loan_paid_WITH_interest-$loan_received;
                            $expected_interest=$expected_loan_WITH_interest-$loan_borrowed;
                            $saving=admin('registration','saving');
                            $tem_saving=admin('temporary','tem_saving');
                            $total_interest =$expected_interest-$interest_recieved;
                            echo '<h6>total money lended: N'.$lended.'</h6>';
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form role="form" method='<?php echo "POST" ?>' action='<?php echo htmlspecialchars("record.php") ?>' >
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username ">
                    </div>
                    <div class="form-group text-center">
                       <input type="submit" class="btn btn-primary" value="check" name="submit" style="width:100%">
                   </div>
               </div>
               <div class="col-sm-4"></div>
           </div>
       </div>
       <!-- table -->
   </div class="container">
   <div class="row">
    <div class="col-sm-12">

      <div class="table-responsive">           
        <table class="table table-striped">
          <thead>
            <tr>
                <th>Loan Received</th> 
                <th>Loan Borrowed</th>
                <th>Expected Total Loan with Interest</th>
                <th>Total Money Lended</th>
                <th>Interest Recieved</th>
                <th> Total Expected Interest</th>
                <th> Total Interest Out</th>
                <th> Total Saving</th>
                <th>Uncredited Total Saving</th>
            </tr>
        </thead>
        <tbody>
          <tr>
              <td><?php echo $loan_received ?></td>
              <td><?php echo $loan_borrowed ?></td>
              <td><?php echo $expected_loan_WITH_interest ?></td>
              <td><?php echo $lended ?></td>
              <td><?php echo $interest_recieved ?></td>
              <td><?php echo $expected_interest ?></td>
              <td><?php echo $total_interest ?></td>    
              <td><?php echo $saving ?></td>  
              <td><?php echo $tem_saving ?></td>        
          </tr>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</body>
</html>
<?php else:header('location:login.php');endif ?>
