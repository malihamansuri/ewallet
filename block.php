
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
<?php
$id = $_GET['id'];
echo $id;
$email = $_GET['email'];
echo $email;

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

// sql to delete a record
$sql = "UPDATE register
SET status = 'block' WHERE r_id='$id'";

if ($conn->query($sql) === TRUE) {
  	header("Location: admin_home.php");
  	echo "";
} else {
  echo "Error deleting record: " . $conn->error;
}


$conn->close();
?>