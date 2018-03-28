<?php
include("connect.php");
session_start();
if(isset($_POST['submit_entry'])) {
		// Escape user inputs for security
		$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);
		$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
		$staff_name = mysqli_real_escape_string($conn, $_REQUEST['staff_name']);

	if($license_num>0){
		// attempt insert query execution
		$sql = "INSERT INTO airport_staff VALUES ('$license_num', '$position', '$staff_name')";
		if(mysqli_query($conn, $sql)){
			echo "Records added successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}
	} else{
		echo "error";
		echo $license_num;
	}
	
		
}
// close connection
mysqli_close($conn);
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Record Form</title>
</head>
<body>
<form action="" method="post">
    <p>
        <label for="license_num">License Num:</label>
        <input type="text" name="license_num" id="license_num">
    </p>
    <p>
        <label for="position">Position:</label>
        <input type="text" name="position" id="position">
    </p>
    <p>
        <label for="staff_name">Name:</label>
        <input type="text" name="staff_name" id="staff_name">
    </p>
    <input type="submit" value="Submit" name="submit_entry">
	
</form>
	
	<br>
	<br>
	<?php
	include("connect.php");
	
	$sql = "SELECT * FROM airport_staff"; //WHERE arrtime >'$now'
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<table><tr><th>License No</th><th>Position</th><th>Name</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["license_num"]. "</td><td>" . $row["position"]. "</td><td>" . $row["staff_name"]. "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "0 results";
	}
	// close connection
	mysqli_close($conn);
    ?>
</body>
</html>