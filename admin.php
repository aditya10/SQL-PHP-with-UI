

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
    <input type="submit" value="Add Person" name="submit_entry">
	<input type="submit" value="Search" name="search_license">
	<input type="submit" value="Delete" name="delete_license">
	<input type="submit" value="Update" name="update_license">
	
</form>
	
	
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
		echo "Error: invalid license number entered.";
	}
}

if(isset($_POST['search_license'])) {
		// Escape user inputs for security
		$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);

	$sql = "SELECT * FROM airport_staff WHERE license_num='$license_num'";
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
}

if(isset($_POST['delete_license'])) {
		// Escape user inputs for security
		$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);

	if($license_num>0){
		// attempt insert query execution
		$sql = "DELETE FROM airport_staff WHERE license_num='$license_num'";
		if(mysqli_query($conn, $sql)){
			echo "Record deleted successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}
	} else{
		echo "Error: invalid license number entered.";
	}
}
	
if(isset($_POST['update_license'])) {
		// Escape user inputs for security
		$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);
		$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
		$staff_name = mysqli_real_escape_string($conn, $_REQUEST['staff_name']);

	if($license_num>0){
		// attempt insert query execution
		$sql = "UPDATE airport_staff SET position='$position', staff_name='$staff_name' WHERE license_num='$license_num'";
		if(mysqli_query($conn, $sql)){
			echo "Record updated successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}
	} else{
		echo "Error: invalid license number entered.";
	}
}



// close connection
mysqli_close($conn);
?>
	
	
	
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