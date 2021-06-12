<nav class="navbar navbar-expand-md">
<!-- bg-dark navbar-dark -->
  <a class="navbar-brand" href="#">Cooperative Society</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto mr-auto">
     <?php 
     if(isset($_SESSION['login_admin']) || isset($_SESSION['username'])){
         $username = !empty($_SESSION['login_admin'])?$_SESSION['login_admin']:$_SESSION['username'];
         if(isset($_SESSION['username'])){
     ?>
    <li class=" nav-item "> <a class="nav-link" href="fundAccount.php">Fund wallet</a></li>  
    <li class=" nav-item "> <a class="nav-link" href="load.php">Loan</a></li>  
    
     <?php } ?>
    <li class=" nav-item active"> <a class="nav-link" href="dashboard.php"><?php echo ucwords($username) ?></a></li>  
    <li class=" nav-item "> <a class="nav-link" href="logout.php">Logout</a></li>  
     <?php }else{?>
      <li class=" nav-item active"> <a class="nav-link" href="index.php">Login</a></li>  
      <li class=" nav-item"><a  class="nav-link" href="register.php">Register</a></li>

      <li class=" nav-item"><a  class="nav-link"href="admin.php">Admin</a></li> 
      <?php } ?>
      <li class=" nav-item"><a  class="nav-link" href="dashboard.php">My Account</a></li>     
    </ul>
  </div>  
</nav>
