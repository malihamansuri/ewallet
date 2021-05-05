<?php
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
} 

?>

<?php
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

         
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">KYC List</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Users List</a>
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
                    <th>File Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                     <th>Download</th>
                    <th>Verified</th>


                  </tr>
                  </thead>
                       <?php
                    $sql = "SELECT register.email, kyc.file_name, kyc.r_id, register.accountnumber, register.phonenumber  FROM kyc,register WHERE kyc.r_id =register.r_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["r_id"]. " - accountnumber: " . $row["accountnumber"]. "- file: " . $row["file_name"]. "<br>";
                                $id = $row["r_id"];

                                echo"<tr>";
                                echo"<td>".$row["r_id"]."</td>";
                                echo"<td>".$row["file_name"]."</td>";
                                echo"<td>".$row["email"]."</td>";
                                echo"<td>".$row["phonenumber"]."</td>";
                                echo"<td>".$row["accountnumber"]."</td>";

                                echo"<td><a href='uploads/".$row['file_name']."'>
                                        Download
                                    </a></td>";

                                echo"<td><a href='verified_action.php?id=$id'>verified</a></td>";
                                echo"</tr> ";
                      }
                    
                    } else {
                      echo "0 results";
                    }
                    ?>
                      <tfoot>
                  <tr>
                   <th>Id</th>
                    <th>File Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                    <th>Download</th>
                    <th>Verified</th>
                  </tr>
                  </tfoot>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                     <table id="example2" class="table table-bordered table-striped">
                      <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Block</th>
                    <th>Unblock</th>
                  </tr>
                  </thead>
                    <?php
                    $sql = "SELECT r_id, name, email, phonenumber, accountnumber, role, status FROM register";
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
                                  echo"<td>".$row["role"]."</td>";
                                  echo"<td>".$row["status"]."</td>";
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
                    <th>Role</th>
                    <th>Status</th>
                    <th>Block</th>
                    <th>Unblock</th>
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

<?php include("common/footer.php"); ?>
  <script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
  $(function () {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
</body>
  </html>


               
