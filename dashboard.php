<?php session_start();
if(isset($_SESSION['login']) && isset($_SESSION['username'])):
  if($_SESSION['username']!=null):
    $err_message="";
    include("database.php");
    $username=$_SESSION['username'];
    $debt=   count(amount('loan',$username)) > 0? amount('loan',$username)['loan_borrowed']-amount('loan',$username)['loan_received']:0;
    $total=0;
    if($debt){
    $interest=$debt*(4/100)*(amount('loan',$username)['last_loan_duration']);
    $total=$debt+$interest;
    }
    if(isset($_GET['data'])){
      header('location:data.php');
    }
    if(isset($_GET['pay_loan'])){
      if($total>0){
        $_SESSION['debt']=$debt;
        $_SESSION['total']=$total;
        header('location:pay_loan.php');
      }else {
        $err_message="You dont have any borrowed loan";
      }}
      if(isset($_GET['loan'])){
        header('location:loan.php');
      }
      if(isset($_GET['fundAccount'])){
        header('location:fundAccount.php');
      }
      if(isset($_GET['withdraw'])){
        header('location:withdraw.php');
      }
      if(isset($_GET['logout'])){
        session_destroy();
        header('location:login.php');
      }
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
<?php include('style.php') ?>
        <title>Dashboard</title>
      </head>
      <body>
        <?php include('header.php') ?>
        <br><br><br>
        <div class="container">
          <div class="row">
            <?php if(isset($_SESSION['suc'])):?>
              <div class='text-center but-success'>
               <?php echo $_SESSION['suc'];
               unset($_SESSION['suc']) ;   ?>
             </div>
           <?php endif ?>
           <div class="col-sm-4">
            <h2>My Account
            </h2>
            <div class="panel panel-default">
              <div class="panel-body btn-info text-center
              ">
              <h6>Saving</h6>
              <h4>
                <?php 
                echo '#'. amount('registration',$username)['saving'];
                ?></h4>
              </div>
              <h4>
                <ul class="pager">
                  <li ><a href="?fundAccount">Save Money</a></li>
                  <?php if(amount('registration',$username)['saving']>999):?>
                    <li ><a href="?withdraw">Withdraw</a></li>
                  <?php endif;?>
                </ul>
                <ul class='list-group'>
                  <li class="list-group-item text-center">
                   
                   <h5> Interest: ₦<?php echo count(amount('interest_per_head',$username)) > 0 ? amount('interest_per_head',$username)['interest']:0; ?></h5>
                 </li>
               </ul>
             </h4>
           </div>
         </div>
         <div class="col-sm-4">
          <h2>Quick action
          </h2>
          <div class="panel panel-default">
            <div class="panel-body btn-info text-center">
              <h4 class="text-center">Uncredited Money</h4>
              <h4  class="text-center">₦ <?php echo count(amount('temporary',$username))>0?amount('temporary',$username) ['tem_saving']:0;?></h4>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><a href="?fundAccount">Sow Seed (Save for fututre)</a></li>
              <li class="list-group-item"><a href="?loan">Loan Money</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <h2>Amount to be  Refunded </h2>
          <div class="panel panel-default">
            <div class="panel-body btn-info text-center">
              <h4><?php

              echo 'N'.$total;
              if($err_message!=null) 
              {
                echo $err_message;
              }

              ?>
            </h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item"
            ><a href="?fundAccount">Sow seed</a></li>
            <li class="list-group-item"><a href="?loan">Loan Money</a></li>
            <?php if($total>0):?>
             <li class="list-group-item"><a href="?pay_loan">Pay Loan</a></li>
           <?php endif;?>
         </ul>
       </div>
     </div>
   </div>
   <div class="container-fluid">
    <div class="row"style="background:lightgreen">
      <div class="col-sm-4">     
        <div class="panel-body btn-default text-center"> 
         <div class="panel panel-default">
          <p >
            <img src="image/fundcooperative.jpg" class="img-responsive"alt="">
          </p>

        </div>
        <h4>
          <ul class="pager">
            <li ><a href="?fundAccount">Sow Seed (Save for future)</a></li>
          </ul>
        </h4>
      </div>
    </div>
    <br>
    <div class="col-sm-4">
      <div class="panel-body btn-default text-center"> 
        <div class="panel panel-default">
          <p >
            <img src="image/loan.jpg" class="img-responsive"alt="">
          </p>
        </div>
        <h4>
          <ul class="pager">
            <li ><a href="?loan">Loan Money</a></li>

          </ul>
        </h4>
      </div>
    </div>
    <br>
    <div class="col-sm-4">
      <div class="panel-body btn-default text-center"> 
        <div class="panel panel-default">
          <p >
            <img src="image/fundcooperative1.jpg" class="img-responsive"alt="">
          </p>
        </div>

        <h4>
          <ul class="pager">
            <li ><a href="checktransactions.php">Check My Transactions</a></li>
          </ul>
        </h4>
      </div>
    </div>
    <br>
  </div>
  <hr>
  <h2 class="text-center list-group"
  ><span class="list-group-item">
  Transaction history</span></h2>
  <!-- table -->
  <div class="row">
    <div class="col-sm-6">
      <h4 class="text-center">
        Credit  side
      </h4>
      <div class="table-responsive">           
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $connection= history('transactions',$username,'saving');
            $count=1;
            while($get_id=mysqli_fetch_assoc($connection)):?>
              <tr>
                <td>
                  <?php echo $count; ?>
                </td>
                <td><?php echo $get_id['username']; ?>
              </td>
              <td>
                <?php echo $get_id['Amt']; ?>

              </td>

              <td><?php echo $get_id['date']; ?>
            </td>
            <td> <?php echo $get_id['time']; ?>
          </td>
        </tr>
        <?php $count++;
      endwhile;?>
    </tbody>
  </table>
</div>
</div> 
<div class="col-sm-6">
  <h4 class="text-center">
   Debit  Side
 </h4>
 <div class="table-responsive">           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Amount</th>
        <th>amount Returned Without Interest</th>
        <th>Date</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $connection= history('transactions',$username,'paid_loan');
      $count=1;
      while($get_id=mysqli_fetch_assoc($connection)):?>
        <tr>
          <td>
            <?php echo $count; ?>
          </td>
          <td><?php echo $get_id['username']; ?>
        </td>
        <td>
          <?php echo $get_id['Amt']; ?>
        </td>
        <td><?php echo $get_id['to_refund']; ?>
      </td>
      <td> <?php echo $get_id['date']; ?>
    </td>
    <td> <?php echo $get_id['time']; ?>
  </td>
</tr>
<?php $count++;
endwhile;
mysqli_close($conn);
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<br><br><br>
<?php
   include('footer.php');
    include('script.php');
     ?>
</body>
</html>
<?php endif;
else:header('location:index.php');endif;?>