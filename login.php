<?php
session_start();
?>
<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>E-</b>WALLET</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type = "email" name ="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type = "password" name = "password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
          <div class="input-group mb-3">         <!-- select -->
          
                <select class="form-control" id="role" name="role" required>
                <option value="user" name="role">User</option>
                <option value="employee" name="role">Merchant</option>
                <option value="merchant" name="role">Employee</option>
              </select>
                    </div>
                    
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" value = "LOGIN " name="submit" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
   
   if(isset($_POST["submit"])) {
      // username and password sent from form 
      
      $email = $_POST['email'];
      $password =$_POST['password']; 
      $role = $_POST['role'];

      $dbrole = " ";
      $dbpassword1 = " ";
      $dbemail = " ";
      $password1 = md5($password);

      
       if($email == "admin@gmail.com" && $password == "admin")
       {
         echo "malihaaa";
          header("Location: admin_home.php");
          $_SESSION['email']=$email;
          $_SESSION['role']="admin";
          $_SESSION['name']="admin";


       }
       else
       {
             //$password1 = md5($password);
             //echo $password1;
             $sql="SELECT r_id, email, password ,role, status, name FROM register WHERE email = '$email'";  
             $result = $conn->query($sql); 
             echo $result->num_rows;
             if($result->num_rows == 1 )  
             {
      

             while($row=$result->fetch_assoc())  
             {  
                $dbemail=$row['email'];  
                $dbpassword=$row['password'];  
                $dbrole = $row['role'];
                $dbid = $row['r_id'];
                $dbstatus = $row['status']; 
                $dbname = $row['name'];



                  echo $dbemail;
                  echo "<br>";
                  echo $dbrole;
                  echo "<br>";
                  echo $dbpassword;
                  echo "<br>"; 
                  echo $dbid; 
                  echo "<br>"; 
                  echo $dbstatus;
                  echo "<br>"; 
                  echo $dbname; 

               
               }
               if($dbpassword == $password1 && $dbrole == "employee")  
                  {  
                      header("Location: employee_home.php");
                      $_SESSION['email']=$dbemail;
                      $_SESSION['id']=$dbid;
                      $_SESSION['role']=$dbrole;
                      $_SESSION['name']=$dbname;
                  }
               else if ($dbpassword == $password1 && $dbrole == "user" )
                  {
                     header("Location: user_home.php");
                     $_SESSION['email']=$dbemail;
                     $_SESSION['id']=$dbid;
                     $_SESSION['role']=$dbrole;
                     $_SESSION['name']=$dbname;
                  }
               else if ($dbpassword == $password1 && $dbrole == "merchant")
                  {
                     header("Location: merchant_home.php");
                     $_SESSION['email']=$dbemail;
                     $_SESSION['id']=$dbid;
                     $_SESSION['role']=$dbrole;
                     $_SESSION['name']=$dbname;
                  }
               else
                  {
                     
                     echo "invalid email password";
                  }
               
  
       }
     
}
}
?>
