<?php session_start();
$err=[];
$username=$_POST['username'];
if(isset($_SESSION['login_admin']) && ($_SERVER['REQUEST_METHOD']=='POST')):?> 
  <?php
if(empty($username)):
  array_push($err,'username is required');
else:
  include('database.php');
  $username1=amount('registration',$username)['username'];
  if($username1!=null):
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
      <link rel="stylesheet" href="css/register.css" >

      <title>Document Records</title>
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
       <span class="navbar-brand" >@admin  pannel
       </span>
       <div class="container">
         <div class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
             <li class="active"><a href="Register.php">Register</a></li>
             <li class="active"><a href="login.php">Login</a></li>
           </ul>
         </div>
       </div>
     </nav>
     <br><br><br>
     <div class="container">
      <div class="row">
        <p class="text-center"
        >  <?php echo amount('registration',$username)['name'];
        ; ?></p>

        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
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
                $connection= history('transactions',$username1,'saving');
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
</div>
<div class="row">
  <div class="col-sm-2">
  </div>
  <div class="row">
    <p>  <?php echo 'money borrowed history'
    ?></p>

    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <div class="table-responsive">           
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Amount</th>
              <th>Date</th>
              <th>
                Duration
              </th>

            </tr>
          </thead>
          <tbody>
            <?php
            $connection= history('transactions',$username1,'borrow');
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
<div class="col-sm-2">
</div>
</div>
<div class="row">
  <div class="col-sm-2">
  </div>
  <div class="row">
    <p>  <?php echo 'loan paid history
    '; ?></p>

    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <div class="table-responsive">           
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Amount with Intrest

                <th>Amount</th>
              </th>
              <th>Date</th>
              <th>Time</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $connection= history('transactions',$username1,'paid_loan');
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
              <td>
                <?php echo $get_id['to_refund']; ?>

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
<div class="col-sm-2">
</div>
</div>
<div class="row">
  <div class="col-sm-2">
  </div>
  <div class="row">
    <p>  <?php echo 'loan paid history
    '; ?></p>

    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <div class="table-responsive">           
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Total
               Amount borrowed

               <th>Total Amount borrowed with Interest
               </th>
             </th>
             <th>Total Amt paid with Interest
             </th>

             <th>Loan received without Interest
             </th>
             <th>Loan received with Interest
             </th>
             <th>Last Update
             </th>
           </tr>
         </thead>
         <tbody>
          <?php
          $get_id= amount('loan',$username1);

          ?>

          <tr>
            <td>
            1                                        </td>
            <td><?php echo $get_id['username']; ?>
          </td>
          <td>
            <?php echo $get_id['loan_borrowed']; ?>

          </td> 

          <td>
            <?php echo $get_id['loan_with_interest']; ?>

          </td>

          <td><?php echo $get_id['loan_paid_WITH_interest']; ?>
        </td>
        <td> <?php echo $get_id['loan_received']; ?>
      </td>
    </td>

    <td> <?php echo $get_id['last_update']; ?>
  </td>                  
</tr>

</tbody>
</table>
</div>

</div>
<div class="col-sm-2">
</div>
</div>

<?php endif;endif;else:array_push($err,'invalid user');endif;
?>



