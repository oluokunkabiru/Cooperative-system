<?php
session_start();
$errs=[];
include('function.php');
if(isset($_POST['submit'])){
  $amount=input($_POST['amount']);
  if(empty($amount)  || $amount==null){
    array_push($errs,"amount is required");
  }else{
    $amount=(int)$amount;
    if ((filter_var($amount, FILTER_VALIDATE_INT )!==0)){
     if($amount<1000) {
      array_push($errs,"amount must be greater than 999");
    } 
  }else{
    array_push($errs,"invalid input");
  }
}
if(count($errs)==0){
 include('database.php');
//  echo "hello";
 $username=$_SESSION['username'];
 $email=amount('registration',$username)['email'];
 $date=date("d-m-y");
 $time= (date("h")-1)."-".date("i-sa");
 $type="saving";
 $to_refund="saving";
 tran_update($username,$email,$type,$to_refund,$amount,$date,$time);
 $total_amount=isset(amount('temporary',$username)['tem_saving'])?amount('temporary',$username)['tem_saving']:0;
 $total_amount +=  $amount;
 $sql="UPDATE temporary SET tem_saving='$total_amount' WHERE username='$username'";

 $total_amount=isset(amount('temporary',$username)['saving'])?amount('temporary',$username)['saving']:0;
 $total_amount +=$amount;
 echo $total_amount;
 $sql1="UPDATE temporary SET saving='$total_amount' WHERE username='$username'";
 $connection=mysqli_query($conn,$sql);
 
 $connection1=mysqli_query($conn,$sql1);
//  if($connection1){
//    echo "success";
//  }else{
//    echo "Faill " . mysqli_error($conn);
//  }
 header('location:dashboard.php');
 exit();
}else {
  $_SESSION['err']=$errs;
  header("location:fundAccount.php");
  exit();
}
}
?>