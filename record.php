<?php session_start();
$err=[];
$usernames=$_POST['username'];
if(isset($_SESSION['login_admin']) && ($_SERVER['REQUEST_METHOD']=='POST')):?> 
  <?php
if(empty($usernames)):
  array_push($err,'username is required');
else:
  include('database.php');
  $usernames1=amount('registration',$usernames)['username'];
  if($usernames1!=null):
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <?php
   include('style.php');
     ?>
      <title>Document Records</title>
    </head>
    <body>
    <?php
   include('header.php');
     ?>
     <br><br><br>
     <div class="container">
      <div class="row">
        <p class="text-center font-weight-bold"
        >  <?php echo ucwords(amount('registration',$usernames)['name']);
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
                $connection= history('transactions',$usernames1,'saving');
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
            $connection= history('transactions',$usernames1,'borrow');
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
            $connection= history('transactions',$usernames1,'paid_loan');
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
          $get_id= amount('loan',$usernames1);

          ?>

          <tr>
            <td>
            1                                        </td>
            <td><?php echo isset($get_id['username'])?$get_id['username']:""; ?>
          </td>
          <td>
            <?php echo isset($get_id['loan_borrowed'])?$get_id['loan_borrowed']:""; ?>

          </td> 

          <td>
            <?php echo isset($get_id['loan_with_interest'])?$get_id['loan_with_interest']:""; ?>

          </td>

          <td><?php echo isset($get_id['loan_paid_WITH_interest'])?$get_id['loan_with_interest']:""; ?>
        </td>
        <td> <?php echo isset($get_id['loan_received'])?$get_id['loan_received']:""; ?>
      </td>
    </td>

    <td> <?php echo isset($get_id['last_update'])?$get_id['last_update']:""; ?>
  </td>                  
</tr>

</tbody>
</table>
</div>

</div>
<div class="col-sm-2">
</div>
</div>
</div>
</div>

<?php endif;endif;else:array_push($err,'invalid user');endif;
?>



