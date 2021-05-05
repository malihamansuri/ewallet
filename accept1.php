<?php include 'common/header.php';?>

<?php include 'common/navbar.php';?>

<?php include 'common/sidebar.php';?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
	<div class="sidebar">
  <p></p>
  <a href="user_home.php?id=<?php echo $id;?>&email=<?php echo $email?>">Home</a>
  <a class="active" href="#wallet">Wallet</a>
  

<?php  
echo "<a href='logout.php'>Log Out</a>";
 if(isset($_POST["wallet"]))
 {
 	$id = $_GET['id'];
 	$email = $_GET['email'];

 	header("Location: accept.php?id=$id&email=$email");
 }

?>
</div>
<div class="content">
<form action="" method="post">
	<div class="card-body">
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text">
			@
			</span>
		</div>
		<input class="form-control" type="email" name="to_email" placeholder="Email"><br><br>
	</div>

	<div class="input-group mb-3">
		<input class="form-control" type="text" name="amount"><br><br>
		<div class="input-group-append">
			<span class="input-group-text">
			.00
			</span>
		</div>
	</div>
	<input class="btn btn-block btn-primary" type="submit" name="transfer" value="transfer" onclick="return mess();"><br><br>
	</div>

	<div class="money-container">
	<input type="text" name="money" placeholder="Money">
	<input type="submit" name="add_money" value="Add" onclick="return mess2();">
	</div> 

</form>
</div>
<script type="text/javascript">
	function mess(){
		alert("money transfered");
	}
	function mess2(){
	alert("money added");
}
</script>
<?php include 'common/footer.php';?>
</body>
</html>

<?php 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) 
	{
	  die("Connection failed: " . $conn->connect_error);
	}
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
	  	echo "<p class='heading'>Wallet Money</p>";
  		echo "<p class='total_amount'>".$total_amount."</p>";
  		echo "</div>";
	}



// sql to delete a record

	  	//header("Location: user_home.php?id=$id");
	  	//$amount = $_GET['amount'];
	  	//echo $amount;
		



if(isset($_POST["add_money"])) {
	$money = $_POST['money'];
	$email = $_GET['email'];

  

   $sql = "UPDATE accounts SET amount= amount + '$money' WHERE name = '$email'";

   if ($conn->query($sql) === TRUE) 
   {
     header("Location:accept.php?id=$id & email=$email");
     exit;
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }

	# code...
}

if (isset($_POST["transfer"]))
{
	$amount = $_POST['amount'];
	$from_email = $_GET['email'];
	$to_email = $_POST['to_email'];
	$from_total = $total_amount - $amount;
	$r_id = $_GET['id'];


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
