
<?php session_start(); if(isset($_SESSION['admin'])){
  include('database.php');
  $saving_query="SELECT SUM(saving) AS total3 FROM registration";
  $saving_query_connection=mysqli_query($conn,$saving_query);
  while ($row=mysqli_fetch_assoc($saving_query_connection)) {
    /*saving*/      $sum_saving=$row['total3'];
  }
  $sum_loan_received_query="SELECT SUM(loan_received) AS total FROM loan";
  $sum_loan_received_query_connection=mysqli_query($conn,$sum_loan_received_query);

  while($row= mysqli_fetch_assoc($sum_loan_received_query_connection))
  {
    /*receive*/    $sum_loan_received= $row['total'];
  };
  $sum_loan_received_query="SELECT SUM(loan_paid_with_interest) AS total FROM loan";
  $sum_loan_received_query_connection=mysqli_query($conn,$sum_loan_received_query);

  while($row= mysqli_fetch_assoc($sum_loan_received_query_connection))
  {
    /*insterstreceive*/    $sum_loan_paid_with_interest= $row['total'];
  };
  $interest= $sum_loan_paid_with_interest-$sum_loan_received;
  $date=date("d-m-y");
  $from_database="SELECT SUM(interest) AS total FROM interest";
  $from_databasecon=mysqli_query($conn,$from_database);
  while($from_databaseconnect=mysqli_fetch_assoc($from_databasecon)){
   $interest_from_database=$from_databaseconnect['total'];
 }
 $real_interest=$interest-$interest_from_database;
 echo $real_interest;
         //update the real interest to database
 $interest_sql="INSERT INTO interest(id,interest,date) VALUES ('NULL','$real_interest','$date')";
 mysqli_query($conn,$interest_sql);

 $sql_all="SELECT *FROM registration";
 $sql_all_con=mysqli_query($conn,$sql_all);
 while ($content=mysqli_fetch_assoc($sql_all_con)) {
  $username=$content['username'];
  $saving=$content['saving'];
  if($saving>0){
    $interest_per_head=($saving/$sum_saving)*$real_interest;
    echo
    $interest_per_head.'<br>';
    $i=amount('interest_per_head',$username)['interest'];
    $interest_per_head=$i+$interest_per_head;
    $sql="UPDATE interest_per_head SET interest='$interest_per_head' WHERE username='$username'";
    mysqli_query($conn,$sql);
  }
  $content1=amount('temporary',$username);
  $tem_saving=$content1['tem_saving'];
  $total=$saving+$tem_saving;
  $sql_all_update="UPDATE registration SET saving='$total' WHERE username='$username'";
  $sql_all_update1="UPDATE temporary SET tem_saving='0' WHERE username='$username'";
  $sql_all_update2="UPDATE temporary SET status='debit' WHERE username='$username'";
  mysqli_query($conn,$sql_all_update);
  mysqli_query($conn,$sql_all_update1);
  mysqli_query($conn,$sql_all_update2);
}
}else{
  echo 'fool';
}
?>