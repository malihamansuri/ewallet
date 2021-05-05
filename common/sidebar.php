<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">E-Wallet</span>
  </a>
<?php 
if($_SESSION["role"]=="user")
{

?>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
   

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="user_home.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i></i>
            <p>
              Home
            </p>
          </a>
    
        </li>
        <li class="nav-item">
          <a href="accept.php" class="nav-link">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Wallet
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#example1" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              View Transaction
            </p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#example2" class="nav-link">
            <i class="nav-icon fas fa-hand-holding-usd"></i></i>
            <p>
              Request List
            </p>
          </a>
    
        </li>
        
        <li class="nav-item">
          <a href="#complain" class="nav-link">
            <i class="nav-icon fas fa-envelope-open-text"></i></i>
            <p>
              Complains
            </p>
          </a>
        </li>
          </ul>
               
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <?php
  }

  if($_SESSION["role"]=="employee")
  {
  ?>
     <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
   

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#custom-tabs-four-users-tab" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#custom-tabs-four-account-tab" class="nav-link">
            <i class="nav-icon fas fa-id-badge"></i>
            <p>
              My Account
            </p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              View Transaction
            </p>
          </a>
    
        </li>
        
        <li class="nav-item">
          <a href="#complain" class="nav-link">
            <i class="nav-icon far fa-envelope-open-text"></i>
            <p>
              View Complains
            </p>
          </a>
        </li>
          </ul>
               
    </nav>
    <!-- /.sidebar-menu -->
  </div>
<?php
   }
   if($_SESSION["role"]=="merchant")
  {
  ?>
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
   

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#mytable" class="nav-link">
            <i class="nav-icon fas fa-id-badge"></i>
            <p>
              My Account
            </p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              View Transaction
            </p>
          </a>
    
        </li>
        
          </ul>
               
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <?php
}
if($_SESSION["email"]=="admin@gmail.com")
  {
?>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
  
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#mytable" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              KYC List
            </p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
    
        </li>
        
          </ul>
               
    </nav>
    <!-- /.sidebar-menu -->
  </div>
<?php
}
?>

</aside>