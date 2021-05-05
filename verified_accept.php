<?php
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
} 
?>
<?php 

$id = $_SESSION['id'];
//echo $id;
$email = $_SESSION['email'];
//echo $email;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_system";


//accept request

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }
$email = $_SESSION['email'];
$sql = "SELECT amount FROM accounts WHERE name='$email'";

   $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
  // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      $total_amount=$row["amount"];
    }
      echo "<div class='amount-box'>";
     
      echo "</div>";
  }



// sql to delete a record

      //header("Location: user_home.php?id=$id");
      //$amount = $_SESSION['amount'];
      //echo $amount;
    

	  	//header("Location: user_home.php?id=$id");
	  	$amount = $_GET['r_amount'];
	  	//echo $amount;
		$from_email = $_GET['email'];
		$to_email = $_GET['to_email'];
		$from_total = $total_amount - $amount;
 		$r_id = $_SESSION['id'];

 		$sql = "SELECT amount FROM accounts WHERE name='$to_email'";

		   $result = $conn->query($sql);

		  if ($result->num_rows > 0) 
		  {
		  // output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		      $total_amount_reciver=$row["amount"];
		    }
		    $to_total = $total_amount_reciver + $amount;
		  }
		if($total_amount > $amount)
			{

	   $sql = "INSERT INTO transaction(t_from, t_to, amount, from_total_amount, to_total_amount, r_id) VALUES ('$from_email','$to_email','$amount','$from_total','$to_total','$r_id')";

	   if ($conn->query($sql) === TRUE) {
	   	 $sql = "UPDATE accounts SET amount= amount - '$amount' WHERE name='$from_email'";

			if ($conn->query($sql) === TRUE) {
			  $sql = "UPDATE accounts SET amount= amount + '$amount' WHERE name='$to_email'";
				if ($conn->query($sql) === TRUE) 
				{
				  $sql = "DELETE FROM request WHERE request_id='$id'";

						if ($conn->query($sql) === TRUE) 
						{
							echo"";
						}
						else 
						{
						  echo "Error deleting record: " . $conn->error;
						}
				} 
				else 
				{
				  echo "Error updating record: " . $conn->error;
				}

			}
			else 
			{
			  echo "Error updating record: " . $conn->error;
			}
    //      header("Location:accept.php??id=$id&email=$email");
			echo "<script>alert('money transfered')</script>";
			//header("Location:accept.php??id=$id&email=$email");
	   } 
	   else 
	   {
	     echo "Error: " . $sql . "<br>" . $conn->error;
	   }
	  	echo "";

}


  # code...


if (isset($_POST["transfer"]))
{
  $amount = $_POST['amount'];
  $from_email = $_SESSION['email'];
  $to_email = $_POST['to_email'];
  $from_total = $total_amount - $amount;
  $r_id = $_SESSION['id'];


  $sql = "SELECT amount FROM accounts WHERE name='$to_email'";

   $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
  // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      $total_amount_reciver=$row["amount"];
    }
    $to_total = $total_amount_reciver + $amount;
  }


   $sql = "INSERT INTO transaction(t_from, t_to, amount, from_total_amount, to_total_amount, r_id) VALUES ('$from_email','$to_email','$amount','$from_total','$to_total','$r_id')";

   if ($conn->query($sql) === TRUE) {
     $sql = "UPDATE accounts SET amount= amount - '$amount' WHERE name='$from_email'";

    if ($conn->query($sql) === TRUE) {
      $sql = "UPDATE accounts SET amount= amount + '$amount' WHERE name='$to_email'";
        if ($conn->query($sql) === TRUE) {
        echo "";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    } else {
      echo "Error updating record: " . $conn->error;
    }
    // header("Location:accept.php??id=$id&email=$email");
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }


}

$conn->close();
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
                <h3 class="card-title">Add Money</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
              
          <div class="col-lg-5 col-6">
              <form role="form" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <input type="text" name="money" class="form-control" id="exampleInputPassword1" placeholder="Enter Amount">
                  </div>
                
                <!-- /.card-body -->
                <div class="col-lg-3 col-6">
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="add_money" value="Add Money"> 
                </div>
              </div>
              </div>
              </form>
          </div>       
        </div> 
        </div>     <!-- /.card-body -->
        </div>
        </div>
        
        
        <!-- /.right side -->
        <div class="col-md-6">

        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Money Transfer</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              

          <form role="form">
                <div class="card-body">
                  <div class="form-group">
                  <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  @
                  </span>
                </div>
                <input class="form-control" type="email" name="to_email" placeholder="Email"><br><br>
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        
              <!-- /.card-body -->
        </div>
        </div>


       <!-- / Write code here -->
    <!-- /.container-fluid -->
    </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
 
</body>
</html>
<?php
if(isset($_POST["add_money"])) {
  $money = $_POST['money'];
  $email = $_SESSION['email'];

  

   $sql = "UPDATE accounts SET amount= amount + '$money' WHERE name = '$email'";

   if ($conn->query($sql) === TRUE) 
   {
     exit;
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
   }
?>
<?php include("common/footer.php"); ?>
