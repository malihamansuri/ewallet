<?php
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
} 

$email = $_SESSION['email'];
//echo $email;

$id = $_SESSION['id'];
//echo $id;

//echo "welcome ".$_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<?php include("common/header.php"); ?>

  <!-- Navbar -->
<?php include("common/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include("common/sidebar.php"); ?>

<?php include("config.php"); ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashbord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <!-- Write code here -->
       <div class="row">
       <div class="col-md-6">
         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">upload kyc</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <input type="submit" name="upload" value="Upload" class="input-group-text" id="">
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
                
        
             <!-- /.card-body -->
        
                
        
        <!-- /.right side -->
        <div class="col-md-6">

        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Request Money</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              

          <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                  <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  @
                  </span>
                </div>
                <input type="hidden" name="r_from" value="<?php echo $_SESSION['email']?>">
                <input class="form-control" type="email" name="r_to" placeholder="Email"><br><br>
              </div>
            </div>


                <div class="input-group mb-3">
                <input class="form-control" type="text" name="amount"><br><br>
                <div class="input-group-append">
                  <span class="input-group-text">
                  .00
                  </span>
                </div>
              </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="request_submit" class="btn btn-primary" value="submit"></input>
                </div>
              </form>
        
              <!-- /.card-body -->
        </div>
        </div>
          </div>

            <div class="row" id="complain">
              <div class="col-md-6">
         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Complain</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="POST" action="">
                  <div class="form-group">
                    <label>Your Email</label>
                    <input class="form-control" type="email" name="email">
                    </div>

                     <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="details" rows="3"></textarea>
                    </div>

                     <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="complain" value="submit"></input>
                    </div>
                  </div>
                  </form>
              </div>
            </div>
          </div>

       <!-- / Write code here -->
    <!-- /.container-fluid -->
     
   
    <!-- /.content -->

 
</body>
</html>

<?php
// Redirecting back
//header("Location:display_user.php?email=$email");


// Getting uploaded file
if(isset($_POST["upload"]))
{
  if(empty($_FILES['file']['name']))
  {
    echo "<script>alert('please select kyc file first')</script>";
  }
  else
  {
  $file = $_FILES["file"];
  $id = $_SESSION['id'];
  // Uploading in "uplaods" folder
   move_uploaded_file($file["tmp_name"], "uploads/" . $file["name"]);
   $file_name = $file["name"];
   $sql="INSERT INTO kyc(file_name,r_id,approved) VALUES('$file_name','$id','no')";
    mysqli_query($conn,$sql);
    
   
    echo "File sucessfully upload";
    
  }
}

if (isset($_POST["request_submit"])) 
{
  # code...


$r_from = $_POST['r_from'];
$r_to = $_POST['r_to'];
$amount = $_POST['amount'];

$sql = "INSERT INTO request (r_from,r_to,amount)
   VALUES ('$r_from', '$r_to', '$amount')";
if ($conn->query($sql) === TRUE) {
     //header("Location:user_home.php?id=$id&email=$email");
     echo "";
     
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
     }
}


  //$r_from = $_POST['r_from'];
  $email = $_SESSION['email'];
  $sql = "SELECT request_id,r_from, amount, r_date FROM request WHERE r_to='$email'";
  $result = $conn->query($sql);
echo "<section class='content'>";
   echo  "<div class='container-fluid'>";
      echo  "<div class='row'>";
         echo "<div class='col-12'>";
            echo "<div class='card'>";
              echo "<div class='card-header'>";
                echo "<h3 class='card-title'>Request for money</h3>";
              echo "</div>";
              
              echo "<div class='card-body'>";
                echo "<table id='example2' class='table table-bordered table-hover'>";
  
  if ($result->num_rows > 0) {
    
  
  echo "<tr><th>Request From</th><th>Amount</th><th>Date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {

          $id = $row["request_id"];
          $to_email = $row["r_from"];
          $amount = $row["amount"];

          //$amount=$row["amount"];
              echo"<tr>";
              echo"<td>".$row["r_from"]."</td>";
              echo"<td>".$row["amount"]."</td>";
              echo"<td>".$row["r_date"]."</td>";
              echo"<td>";
              echo "<a href='verified_accept.php?id=$id&email=$email&to_email=$to_email&r_amount=$amount'>Accept</a>";
              echo "</td>";
              echo"<td>";
              echo "<a href='Reject.php?id=$id&email=$email'>Reject</a>";
              echo "</td>";
              echo"</tr> ";
    }
    echo "</div>";
    echo "</div>";
  echo "</table>";
}
else
{
  
}

echo "</div>";
echo "</div>";
echo "<div id='complain'>";

if(isset($_POST['complain']))
{
  $description = $_POST["details"];
  $id = $_SESSION["id"];
  $c_email = $_POST["email"];
  $email = $_SESSION["email"];

    $sql = "INSERT INTO complain (email, description, r_id)
  VALUES ('$c_email', '$description', '$id')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('complain saved')</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
echo "<div class='content'>";
echo"<div class='transaction-container'>";
  $email = $_SESSION["email"];
  $sql = "SELECT t_date,t_from,t_to,amount,from_total_amount,to_total_amount FROM transaction WHERE t_from='$email' OR t_to = '$email' ";
  $result = $conn->query($sql);
echo"<table id='example1' class='table table-bordered table-striped'>
                      <thead>
                  <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Credit/Debit</th>
                    <th>Total Amount</th>
                  </tr>
                  </thead>";
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

            echo"<tr>";
            echo"<td>".$row["t_date"]."</td>";
            echo"<td>".$row["t_from"]."</td>";
            echo"<td>".$row["t_to"]."</td>";
            echo"<td>".$row["amount"]."</td>";
            if($row['t_from'] == $email)
            {
            echo"<td>".$row["from_total_amount"]."</td>";
          }
          else if($row['t_to'] == $email)
          {
            echo"<td>".$row["to_total_amount"]."</td>";
          }
          else
          {
            echo"";
          }
            echo"</tr> ";
  }
  echo"<tfoot>
                  <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Credit/Debit</th>
                    <th>Total Amount</th>
                  </tr>
                  </tfoot>";
echo "</table>";
} else 
{
  echo "0 results";
}

echo"</div>";
echo "<div>";
echo "</section>";
$conn->close();
?>
<?php include("common/footer.php"); ?>