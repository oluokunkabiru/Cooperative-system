<?php session_start();

if(isset($_SESSION['login']) && ($_SESSION['username']!=null)):
  ?> 
<?php
$username=$_SESSION['username'];
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
    <?php
   include('style.php');
     ?>
    <title>Check Transaction Event</title>
  </head>
  <body>
  <?php
   include('header.php');
     ?>
  <br><br><br>
  <!-- <div class="container"> -->
    <div class="jumbotron jumbotron-fluid">
      <!-- <div class="row"> -->
        <p class="text-center">  <?php echo "welcome <b>".ucwords(amount('registration',$username)['name'])."</b>";?></p>
        <!-- <div class="col-sm-2">
        </div> -->
        <div class="container card">
          <div class="table-responsive card-body">           
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
                  <td><?php echo $count; ?></td>
                  <td><?php echo $get_id['username']; ?></td>
                  <td><?php echo $get_id['Amt']; ?></td>
                  <td><?php echo $get_id['date']; ?></td>
                  <td> <?php echo $get_id['time']; ?>        </td>
                </tr>
                <?php $count++;
              endwhile;?>
            </tbody>
          </table>
        </div>
      </div>
    <!-- </div> -->
    <!-- <div class="row"> -->
      <!-- <div class="col-sm-2">
      </div> -->
      <!-- <div class="row"> -->
       
        <!-- <div class="col-sm-2">vvvz
        </div> -->
        <div class="container card">
           <h4>  money borrowed history</h4>

          <div class="table-responsive card-body">           
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>username</th>
                  <th>amount</th>
                  <th>date</th>
                  <th>
                    duration
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
              <th>Amount with intrest

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
               Amount Borrowed
               <th>Total Amount Borrowed with Interest
               </th>
             </th>
             <th>Total Amt paid with Interest
             </th>

             <th>Loan Received without Interest
             </th>

             <th>Last Update
             </th>
           </tr>
         </thead>
         <tbody>
          <?php
          $get_id = count(amount('loan',$username1)) > 0?amount('loan',$username1):[];
          ?>
          <tr>
            <td><?php echo isset($get_id['username'])?$get_id['username']:""; ?>
          </td>
          <td>
            <?php echo isset($get_id['loan_borrowed'])?$get_id['loan_borrowed']:""; ?>

          </td> 

          <td>
            <?php echo isset($get_id['loan_with_interest'])?$get_id['loan_with_interest']:""; ?>

          </td>

          <td><?php echo isset($get_id['loan_paid_WITH_interest'])?$get_id['loan_paid_WITH_interest']:""; ?>
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
</div></div></div></div></div>
<?php endif;endif;
?>
<?php
   include('footer.php');
   include('script.php');
     ?>
  </body>
  </html>



