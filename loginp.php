<?php

include('function.php');
$input=['username','password'];
$err=[];
$a[]=$username=input($_POST['username']);
$a[]=$password=input($_POST['password']);
if(($_SERVER['REQUEST_METHOD']=='POST') && ($_POST['submit']))
{
  for($i=0;$i<count($a);$i++){
    if(checkInput($a[$i],$input[$i])!="good"){
      array_push($err,checkInput($a[$i],$input[$i]));
    }
  }
  session_start();
  if(count($err)==0)
  {
    include('database.php');
    $sql_login="SELECT *FROM registration WHERE username='$username' AND password='$password'";
    $connection=mysqli_query($conn,$sql_login);
    $login=mysqli_fetch_array($connection,MYSQLI_ASSOC);
    mysqli_close($conn);
    if($login){
      $_SESSION['login']="success";
      $_SESSION['username']=$username;
      header("location:dashboard.php");
      exit();
    }else{
      array_push($err,'invalid password or username');
    }   
  }
  if(count($err)>0){
    $_SESSION['login_err']=$err;
    header("location:login.php");
    exit();
  }
}
?>