<?php
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
} 
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
<?php 
//echo "welcome ".$_SESSION['email'];  
 

//$id = $_SESSION['id'];
//echo $id;
$email = $_SESSION['email'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

   $sql = "SELECT amount FROM accounts WHERE name='$email'";

   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $total_amount=$row["amount"];
  }
      echo "<div class='amount-box'>";
      
     // echo "<p class='total_amount'>".$total_amount."</p>";
      echo "</div>";
}






?>

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
                <h3 class="card-title">Add Money</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widSESSION="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                 <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $total_amount;?></h3>

                    <p>In Wallet</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </div>
              
          <div class="col-lg-6 col-6">
              <form role="form" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Amount" name="money">
                  </div>
                
                <!-- /.card-body -->
                <div class="col-lg-3 col-6">
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="add_money" value="Add Money" />
                </div>
              </div>
              </div>
              </form>
          </div>       
        </div> 
        </div>     <!-- /.card-body -->
        </div>
        </div>
        

       <!-- / Write code here -->
    <!-- /.container-fluid -->
    </div>
    </div>
    </section>

    <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Transaction</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">My Details</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <table id="example1" class="table table-bordered table-striped">
                      <thead>
                  <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>Amount</th>


                  </tr>
                  </thead>
                       <?php
                       $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "payment_system";
                        $email = $_SESSION['email'];
                        // Create connection
                        $sql = "SELECT t_date , t_from , amount FROM transaction WHERE t_to='$email'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {


                                //$amount=$row["amount"];
                                    echo"<tr>";
                                    echo"<td>".$row["t_date"]."</td>";
                                    echo"<td>".$row["t_from"]."</td>";
                                    echo"<td>".$row["amount"]."</td>";
                                    echo"</tr> ";
                          }
                        
                      }
                    ?>
                      <tfoot>
                  <tr>
                   <th>Date</th>
                    <th>From</th>
                    <th>Amount</th>
                  </tr>
                  </tfoot>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                     <table id="example2" class="table table-bordered table-striped">
                      <thead>
                  
                  </thead>
                       <?php
                       $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "payment_system";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql = "SELECT register.email, register.name, register.phonenumber, register.accountnumber , register.role, accounts.amount
                    FROM register,accounts 
                    WHERE register.email='$email' AND register.r_id=accounts.r_id";

                    $result = $conn->query($sql);
                    echo "<table id='mytable' border=1px solid black>";
                    if($result->num_rows > 0)  
                       {  
                          while($row = $result->fetch_assoc())  
                                {
                                  echo "<tr>";
                                  echo "<td>Name</td>";
                                  echo "<td>";
                                  echo $row["name"];
                                  echo "</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td>Email</td>";
                                  echo "<td>";
                                  echo $row["email"];
                                  echo "</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td>Balance</td>";
                                  echo "<td>";
                                  echo $row["amount"];
                                  echo "</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td>Phonenumber</td>";
                                  echo "<td>";
                                  echo $row["phonenumber"];
                                  echo "</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td>Accountnumber</td>";
                                  echo "<td>";
                                  echo $row["accountnumber"];
                                  echo "</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td>Role</td>";
                                  echo "<td>";
                                  echo $row["role"];
                                  echo "</td>";
                                  echo "</tr>";

                                            }
                                          }
                  
                  $conn->close();
                      ?>
                      <tfoot>
                  </tfoot>
                     </table>
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
          </div>
    <!-- /.content -->
  </div>
 <?php include("common/footer.php"); ?>
</body>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>>
</html>
<?php
if(isset($_POST["add_money"])) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "payment_system";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

   $money = $_POST['money'];
   $email = $_SESSION['email'];

   $sql = "UPDATE accounts SET amount= amount + '$money' WHERE name = '$email'";

   if ($conn->query($sql) === TRUE) {
     echo "<script>alert('money added')</script>";
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }

   # code...
}

?>
