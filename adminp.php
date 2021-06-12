<?php
$err=[];
$username=$_POST['username'];
$password=$_POST['password'];
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(empty($username) || empty($password))
  {
    array_push($err,'everything is required');
  }
  else
  {
    if(($username=='VILLAGEBOY001') && ($password=='VILLAGE54321'))
    {

    }
    else 
    {
      array_push($err,'invalid password or username');
    }
  }

  session_start();
  if(count($err)>0)
  {
    $_SESSION['err_admin']=$err;
    header('location:admin.php');
  }
  else
  {
    $_SESSION['login_admin']=$username;
    header('location:check.php');
  }
}
?>