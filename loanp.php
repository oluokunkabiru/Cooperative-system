<?php
session_start();
$err=[];
if(($_SERVER['REQUEST_METHOD']=="POST") && isset($_POST['submit'])){
 include('database.php');
 include('function.php');
 $amount_to_borrow=$_POST['amount'];
 $duration=$_POST['duration'];
 $username=$_SESSION['username'];
 $saving=amount('registration',$username)['saving'];
 $connect=amount('loan',$username);
 $loan_borrowed=$connect['loan_borrowed'];
 $loan_received=$connect['loan_received'];
 if (empty($amount_to_borrow) || empty($duration)) { 
  array_push($err,'username and duration is required'); 
}else{
 if($amount_to_borrow>999){
   if($duration < 12){
     if($amount_to_borrow <= 2*$saving){
       if($loan_received >= $loan_borrowed){
           //sum all the saving-(loan_borrowed-$loan_received) and saving together and compare;
         $sum_loan_received_query="SELECT SUM(loan_received) AS total FROM loan";
         $sum_loan_received_query_connection=mysqli_query($conn,$sum_loan_received_query);

         while($row= mysqli_fetch_assoc($sum_loan_received_query_connection))
         {
          /*receive*/    $sum_loan_received= $row['total'];
        };
        $sum_loan_borrowed_query="SELECT SUM(loan_borrowed) AS total1 FROM loan";
        $sum_loan_borrowed_query_connection=mysqli_query($conn,$sum_loan_borrowed_query);
        while($row= mysqli_fetch_assoc($sum_loan_borrowed_query_connection))
        {
          /*borrow*/      $sum_loan_borrowed= $row['total1'];
        };
        $saving_query="SELECT SUM(saving) AS total3 FROM registration";
        $saving_query_connection=mysqli_query($conn,$saving_query);
        while ($row=mysqli_fetch_assoc($saving_query_connection)) {
         /*saving*/      $sum_saving=$row['total3'];
       }
       $money_in_saving=$sum_saving-($sum_loan_borrowed-$sum_loan_received);
       if($amount_to_borrow<=$money_in_saving){
//calculation of interest
//amount*4/100*duration
         $interest=($amount_to_borrow*4/100)*$duration;
           //reedit
         $date=date("d-m-y");
         $time=(date("h")-1)."-".date("i-sa");
           //to get some value where username=$username
         $sql_to_borrow="SELECT *FROM loan WHERE username='$username'";
         $sql_to_borrow_conn=mysqli_query($conn,$sql_to_borrow);
         $from_database=mysqli_fetch_array($sql_to_borrow_conn,MYSQLI_ASSOC);
         $from_database_loan_borrowed=$from_database['loan_borrowed'];
         $loan_borrowed_loan_with_interest=$from_database['loan_with_interest'];
         $from_database_loan_borrowed_to_update=$from_database_loan_borrowed+$amount_to_borrow;
         $loan_borrowed_loan_with_interest_update=$loan_borrowed_loan_with_interest+$interest+$amount_to_borrow;
         $update_loan_sql1="UPDATE loan SET loan_with_interest='$loan_borrowed_loan_with_interest_update' WHERE username='$username'";
         $update_loan_sql2="UPDATE loan SET loan_borrowed='$from_database_loan_borrowed_to_update' WHERE username='$username'";
         $update_loan_sql3="UPDATE loan SET last_loan_duration='$duration' WHERE username='$username'";
         $update_loan_sql4="UPDATE loan SET last_update='$time' WHERE username='$username'";
         mysqli_query($conn, $update_loan_sql1);
         mysqli_query($conn, $update_loan_sql2);
         mysqli_query($conn, $update_loan_sql3);
         mysqli_query($conn, $update_loan_sql4);

         $email=amount('registration',$username)['email'];
         tran_update($username,$email,'borrow',$interest+$amount_to_borrow,$amount_to_borrow,$date,$duration);
       }else {
        array_push($err,'You cannot borrow loan at this time'); 
      }
    }else {
      array_push($err,'You are currently with loan'); 
    }
  }else {
    array_push($err,'You can only borrow loan of maximinum of '.(2*$saving));
  }
}else {
 array_push($err,'you can only borrow loan for 12 amount');
}}else {
 array_push($err,'You can only take a loan greater 999');
}}
if(count($err)>0){
  $_SESSION['response']=$err;
  header('location:loan.php');
}else{
  $_SESSION['suc']='loan granted';
  header('location:dashboard.php');
}
}else {
 header('location:index.php');
}
?>