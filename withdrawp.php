<?php
session_start();
$err=[];
if(($_SERVER['REQUEST_METHOD']=="POST") && isset($_POST['submit'])){
 include('database.php');
 include('function.php');
 $amount_to_withdraw=$_POST['amount_to_withdraw'];
 $acc=$_POST['accno'];
 $username=$_SESSION['username'];
 $saving=amount('registration',$username)['saving']; 

 $date=date("d-m-y");
 $time=(date("h")-1)."-".date("i-sa");
 $loan_received=amount('loan',$username)['loan_received'];
 $loan_borrowed=amount('loan',$username)['loan_borrowed'];
 if (empty($amount_to_withdraw) || empty($acc)) { 
  array_push($err,'amount and acc no is required'); 

}else{
 if ($amount_to_withdraw<=$saving) {
   if(ondebt($username,$loan_received,$loan_borrowed)==FALSE){
     if ($amount_to_withdraw<=withdraw()) {
       $reminant=$saving-$amount_to_withdraw;
       $sql_withdraw="UPDATE registration SET saving='$reminant' WHERE username='$username'";
       mysqli_query($conn,$sql_withdraw);
       tran_update($username,'','withdraw',$acc,$amount_to_withdraw,$date,$time);

              // header('location:dashboard.php');
     }else {
      array_push($err,'you cannot withdraw at this time try again later');
    }
  }else {
    array_push($err,'payup yr loaned money and then withdraw');

  }
}
else {
  array_push($err,'insufficient balance');

}}
if(count($err)>0){
  $_SESSION['response']=$err;
  header('location:withdraw.php');
}else{
  $_SESSION['suc']='withdrawn successful';
  header('location:dashboard.php');
}
}else {
  header('location:dashboard.php');
}