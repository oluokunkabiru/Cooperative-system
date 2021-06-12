<?php 
$SERVER="localhost";
$dbusername="root";
$pas="";
$database="SWEP";
$conn=mysqli_connect($SERVER,$dbusername,$pas,$database);
try{
  $reg="CREATE TABLE IF NOT EXISTS registration(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(40) NOT NULL ,
  username VARCHAR(200) NOT NULL,
  bvn VARCHAR(200) NOT NULL,
  password VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phoneno VARCHAR(100) NOT NULL,
  saving DECIMAL(64,6) NOT NULL,
  date VARCHAR(100) NOT NULL,
  time VARCHAR(100) NOT NULL,
  NameofG VARCHAR(100) NOT NULL,
  BvnofG VARCHAR(100) NOT NULL,
  EmailofG VARCHAR(100) NOT NULL,
  PhoneofG VARCHAR(100) NOT NULL
)";
$tran="CREATE TABLE IF NOT EXISTS transactions(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(40) NOT NULL,
email VARCHAR(40) NOT NULL,
type VARCHAR(40) NOT NULL,
to_refund VARCHAR(40) NOT NULL,
Amt DECIMAL(63,6) NOT NULL,
date VARCHAR(40) NOT NULL,
time VARCHAR(40) NOT NULL

)";
$interest="CREATE TABLE IF NOT EXISTS interest(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
interest DECIMAL(63,6) NOT NULL,
date VARCHAR(40) NOT NULL
)";
$temporary="CREATE TABLE IF NOT EXISTS temporary(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(40) NOT NULL,
tem_saving DECIMAL(63,6) NOT NULL,

saving  DECIMAL(63,6) NOT NULL,
status VARCHAR(40) NOT NULL
)";
$loan="CREATE TABLE IF NOT EXISTS loan(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(40) NOT NULL,
loan_borrowed DECIMAL(63,4) NOT NULL,
loan_with_interest  DECIMAL(63,4) NOT NULL,
loan_paid_WITH_interest DECIMAL(63,4) NOT NUll,
loan_received  DECIMAL(63,4) NOT NUll,
last_loan_duration  DECIMAL(63,4) NOT NUll,
last_update VARCHAR(40) NOT NULL)";
$interest_per_head="CREATE TABLE IF NOT EXISTS interest_per_head(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(40) NOT NULL,
interest DECIMAL(63,6) NOT NULL
)"; 
$query0=mysqli_query($conn,$temporary);
$query1=mysqli_query($conn,$loan);
$query=mysqli_query($conn,$reg);
$query2=mysqli_query($conn,$tran);
$query3=mysqli_query($conn,$interest);
mysqli_query($conn,$interest_per_head);
}
catch(Exception $errormsg)
{
  echo $php_errormsg->getMessage();
}
function amount($table_name,$username){
  global $conn;
  $sql_amount="SELECT *FROM $table_name WHERE username='$username'";
  $connection=mysqli_query($conn,$sql_amount);
  $get_amo=mysqli_fetch_array($connection,MYSQLI_ASSOC);
  return isset($get_amo)?$get_amo:[];
};

//admin is this owner
function update($table_name,$username,$total_amount)
{
  global $conn;
  $sql="UPDATE registration SET saving='$total_amount' WHERE username='$username'";
  $connection=mysqli_query($conn,$sql);
}

function history($table_name,$username,$type){
  global $conn;
  $sql_tran="SELECT *FROM $table_name WHERE username='$username' AND type='$type' ";
  $connection=mysqli_query($conn,$sql_tran);
  return $connection;

}

function tran_update($username,$email,$type,$to_refund,$amt,$date,$time)
{ global $conn;
  $sql="INSERT INTO transactions(id,username,email,type,to_refund,Amt,date,time) VALUES ('NULL','$username','$email','$type','$to_refund','$amt','$date','$time')";
  $sumit_query=mysqli_query($conn,$sql);
  if(!$sumit_query)
  {
    
  }
}
function temp($username,$tem_saving,$saving,$status){
  global $conn;
  $tem="INSERT INTO temporary (id,username,tem_saving,saving,status) VALUES ('NULL','$username','$tem_saving','$saving','$status')";
  $tem_con=mysqli_query($conn,$tem);
  if(!$tem_con){
    return mysqli_error($conn);
  }
}
function loan($username,$loan_borrowed,$loan_with_interest,$loan_paid_WITH_interest,$loan_received,$last_loan_duration,$last_update){
  global $conn;
  $loan="INSERT INTO loan (id,username,loan_borrowed,loan_with_interest,loan_paid_WITH_interest,loan_received,last_loan_duration,last_update) VALUES ('NULL','$username','$loan_received','$loan_with_interest','$loan_paid_WITH_interest','$loan_received','$last_loan_duration','$last_update')";
  $loan_con=mysqli_query($conn,$loan);
  
}

function admin($table_name,$colomn){
  global $conn;
  $saving_query="SELECT SUM($colomn) AS total3 FROM $table_name";
  $saving_query_connection=mysqli_query($conn,$saving_query);
  while ($row=mysqli_fetch_assoc($saving_query_connection)) {
    /*saving*/      $sum_saving=$row['total3'];
    
  }
  return $sum_saving;
}
function insert($username,$inter){
  global $conn;
  $sql="INSERT INTO interest_per_head (id,username,interest) VALUES ('NULL','$username','$inter')";
  mysqli_query($conn,$sql);
}


function withdraw(){
  global $conn;
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
    /*borrow*/      $sum_loan_money= $row['total1'];
  };
  $saving_query="SELECT SUM(saving) AS total3 FROM registration";
  $saving_query_connection=mysqli_query($conn,$saving_query);
  while ($row=mysqli_fetch_assoc($saving_query_connection)) {
   /*saving*/      $sum_saving=$row['total3'];
 }
 $total_amount=$sum_saving-($sum_loan_received-$sum_loan_money);
 return $total_amount;
}

function ondebt($username,$loan_received,$loan_borrowed){
  $total_dept=$loan_borrowed-$loan_received;
  if($total_dept>0){
    return TRUE;
  }
  return FALSE;
}
