<?php
session_start();
if(isset($_SESSION['debt']) && isset($_SESSION['total']) && ($_SESSION['total']>0)
  && $_SESSION['total']!=null && $_SESSION['debt']!=null && $_SESSION['username']!=null)
  {   include('database.php');
$time=(date("h")-1)."-".date("i-sa");
$date=date("d-m-y");
$username=$_SESSION['username'];
$debt=    amount('loan',$username)['loan_borrowed']-amount('loan',$username)['loan_received'];
$interest=$debt*(4/100)*(amount('loan',$username)['last_loan_duration']);
$total=$debt+$interest;
$loan_paid_WITH_interest= amount('loan',$username)['loan_paid_WITH_interest']+$total;
$loan_received=amount('loan',$username)['loan_received']+$debt;
$update_loan_sql1="UPDATE loan SET loan_paid_WITH_interest='$loan_paid_WITH_interest' WHERE username='$username'";
$update_loan_sql2="UPDATE loan SET loan_received='$loan_received' WHERE username='$username'";
$update_loan_sql3="UPDATE loan SET last_loan_duration='0' WHERE username='$username'";
$update_loan_sql4="UPDATE loan SET last_update='$time' WHERE username='$username'";
mysqli_query($conn, $update_loan_sql1);
mysqli_query($conn, $update_loan_sql2);
mysqli_query($conn, $update_loan_sql3);
mysqli_query($conn, $update_loan_sql4);
$email=amount('registration',$username)['email'];
tran_update($username,$email,'paid_loan',$debt,$total,$date,$time);
$_SESSION['pay']=$total;
header('location:dashboard.php');
}else {
  echo 'fool';
}
?>