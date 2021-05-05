<?php
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
} 

?>

<?php
$id = $_SESSION["id"];
$email = $_SESSION["email"]; 
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

<head>
	<title></title>
</head>
<body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-users-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Users</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-account-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">My Account</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Transaction</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Complains</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  	<table id="example1" class="table table-bordered table-striped">
                      <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                    <th>Block</th>
                    <th>Unblock</th>
                  </tr>
                  </thead>
                     <?php

                     $sql = "SELECT r_id, name, email, phonenumber, accountnumber FROM register WHERE role='user'";
					$result = $conn->query($sql);
					
					
					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {

					    		$id = $row["r_id"];
					    		$email = $row["email"];
					            echo"<tr>";
					            echo"<td>".$row["r_id"]."</td>";
					            echo"<td>".$row["name"]."</td>";
					            echo"<td>".$row["email"]."</td>";
					            echo"<td>".$row["phonenumber"]."</td>";
					            echo"<td>".$row["accountnumber"]."</td>";
					            echo"<td>";
						        echo "<a href='block.php?id=$id&email=$email'>block</a>";
						        echo "</td>";
						        echo"<td>";
						        echo "<a href='unblock.php?id=$id&email=$email'>unblock</a>";
						        echo "</td>";
					            echo"</tr> ";
					  }
					
					} else 
					{
					  echo "0 results";
					}
					
					?>
					<tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                    <th>Block</th>
                    <th>Unblock</th>
                  </tr>
                  </tfoot>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                     <?php
                     $email = $_SESSION['email'];
					 // echo $email;

					  $sql = "SELECT email, name, phonenumber, accountnumber , role
					  FROM register 
					  WHERE email='$email' ";

					  $result = $conn->query($sql);
					  echo "<table id='mytable'>";
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
					        echo "</table>";
					        ?> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                  	<table id="example1" class="table table-bordered table-striped">
                      <thead>
                  <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>from_amount</th>
                    <th>To_amount</th>
                    <th>Account Number</th>
                  </tr>
                  </thead>
                     <?php
                     $sql = "SELECT transaction.t_id, transaction.t_date, transaction.t_from, transaction.t_to, transaction.amount, transaction.from_total_amount, transaction.to_total_amount, register.accountnumber  FROM transaction,register WHERE transaction.r_id =register.r_id";

					  $result = $conn->query($sql);
				
					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {

					            echo"<tr>";
					            echo"<td>".$row["t_id"]."</td>";
					            echo"<td>".$row["t_date"]."</td>";
					            echo"<td>".$row["t_from"]."</td>";
					            echo"<td>".$row["t_to"]."</td>";
					            echo"<td>".$row["amount"]."</td>";
					            echo"<td>".$row["from_total_amount"]."</td>";
					            echo"<td>".$row["to_total_amount"]."</td>";
					            echo"<td>".$row["accountnumber"]."</td>";
					            echo"</tr> ";
					  }
					} else 
					{
					  echo "0 results";
					}
					?>
					 <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>from_amount</th>
                    <th>To_amount</th>
                    <th>Account Number</th>
                  </tr>
                  </tfoot>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  	 <table id="example1" class="table table-bordered table-striped">
                      <thead>
                  <tr>
                    <th>Email</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <?php
                  $sql = "SELECT email, description
					  FROM complain";
					  $result = $conn->query($sql);
					  if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
					            echo"<tr>";
					            echo"<td>".$row["email"]."</td>";
					            echo"<td>".$row["description"]."</td>";
					            echo"</tr> ";
					  }
					} else 
					{
					  echo "0 results";
					}
					?>
					<tfoot>
                  <tr>
                    <th>Email</th>
                    <th>Description</th>
                  </tr>
                  </tfoot>
                     </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
</div>
</div>
</div>
<?php include("common/footer.php"); ?>
<script type="text/javascript">
	$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
</body>

</html>