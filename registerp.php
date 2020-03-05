<?php
include("function.php");
$input=["name","username","bvn","password","password","email","phone number","name of the guarantor","bvn of Guarantor","Email of the guarantor","phone no of the guarantor"];
$err=[];
//echo $_POST['submit'];
if(($_SERVER["REQUEST_METHOD"]=='POST') && isset($_POST['submit'])){
 $a[] = $name=input($_POST['name']);
 $a[]=  $username=input($_POST['username']);
 $a[]=$bvn=input($_POST['bvn']);
 $a[]= $password=input($_POST['password']);
 $a[]=  $password1=input($_POST['password1']);
 $a[]=  $email=input($_POST['email']); 
 $a[]= $phone_no=input($_POST['phoneno']);
 $saving=0.000;
 $date=date("d-m-y");
 $time=(date("h")-1)."-".date("i-sa");
 $a[]=$NameofG=input($_POST['NameofG']);
 $a[]=$BvnofG=input($_POST['BvnofG']);
 $a[]=$EmailofG=input($_POST['EmailofG']);
 $a[]=$PhoneofG=input($_POST['PhonenoOfG']);
 for($i=0;$i<(count($a));$i++){
   if(checkInput($a[$i],$input[$i])!="good"){
    array_push($err,checkInput($a[$i],$input[$i]));
  }
} 

if (count($err)==0) {

 $test_bvn=(string)($bvn);
 if(strlen($test_bvn)==11){


 }else {
  array_push($err,"invalid bvn");
  array_push($err,strlen($test_bvn));

}
if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
  $email=$email;
}else{
  array_push($err,"invalid email");

}

$password=(string)$password;
$password1=(string)$password1;

$phone_no=  filter_var("$phone_no", FILTER_SANITIZE_STRING);
$password=  filter_var("$password", FILTER_SANITIZE_STRING);
$password1=  filter_var("$password1", FILTER_SANITIZE_STRING);
$username=  filter_var( "$username", FILTER_SANITIZE_STRING);
$email=filter_var($email, FILTER_VALIDATE_EMAIL);
if(strlen($password)<6){
  array_push($err,"password too short");

}elseif ($password!=$password1) {
  array_push($err,"password not the same");
}
}
if (count($err)==0) {
  include('database.php');
  $sql_check="SELECT *FROM registration WHERE username='$username' or email='$email' or phoneno='$phone_no' ";
  $connection=mysqli_query($conn,$sql_check);
  $u=mysqli_fetch_array($connection,MYSQLI_ASSOC);
  if($u['phoneno']==$phone_no){
    array_push($err,"phone no already exist ");
    
  }if($u['email']==$email){
    array_push($err,"email  already exist ");
    
  }if($u['username']==$username){
    array_push($err,"username already exist ");
    
  }if($u['bvn']==$bvn){
    array_push($err,"bvn already exist ");
    
  }
  if(count($err)==0){
    $fin="INSERT INTO registration (id,name,username,bvn,password,email,phoneno,saving,date,time,NameofG,BvnofG,EmailofG,PhoneofG) VALUES ('NULL','$name','$username','$bvn','$password','$email','$phone_no','$saving','$date','$time','$NameofG','$BvnofG','$EmailofG','$PhoneofG')";  
    $insert=mysqli_query($conn,$fin);
    $tem_saving=0;
    $saving=0;
    $status='credit';
    temp($username,$tem_saving,$saving,$status);
    loan($username,0,0,0,0,0,$time);
    insert($username,0);
  }
  mysqli_close($conn);
}
session_start();
if(count($err)!=0){

 $_SESSION['errs']=$err;
 header("location:register.php");
 exit();

}else{
  header("location:login.php");
  $_SESSION['sucess']="thank u for registering ";
  exit();
}

}
else{
  header("location:register.php");
  exit();
}
?>