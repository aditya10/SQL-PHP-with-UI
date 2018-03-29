<html>
	<head>
        <title>Team 11 - CPSC 304 - Airport Admin</title>
        <link rel="stylesheet" href="css/admin.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
	
	<body>
		<?php
		if(isset($_GET['li_num'])){
			$li_num = $_GET['li_num'];
			include("connect.php");

			$sql = "SELECT airline_name FROM airplane_staff WHERE license_num='$li_num'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$airline_name = $row["airline_name"];
		}
		?>
		<div class="header">
			<table>
				<tr>
					<td id="title"><h2>Airport Database - <?php echo $airline_name; ?> Admin Center </h2></td>
				</tr>
			</table>
        </div>
		
		<div class="row" id="airplane-staff">
		<div class="master-form">
				<form action="" method="post">
					<p>
						<label for="license_num">License Num:</label>
						<input type="text" name="license_num" id="license_num">
					</p>
					<p>
						<label for="position">Position: </label>
						<input type="text" name="position" id="position"> (not required for searching/deleting)
					</p>
					<p>
						<label for="staff_name">Name: </label> 
						<input type="text" name="staff_name" id="staff_name"> (not required for searching/deleting)
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
						$sql = "INSERT INTO airline_staff VALUES ('$license_num', '$position', '$staff_name', '$airline_name')";
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

					$sql = "SELECT * FROM airline_staff WHERE license_num='$license_num' AND airline_name='$airline_name'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						echo "<table><tr><th>License No</th><th>Position</th><th>Name</th><th>Airline</th></tr>";
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["license_num"]. "</td><td>" . $row["position"]. "</td><td>" . $row["staff_name"]."</td><td>" . $row["airline_name"]. "</td>";
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
						$sql = "DELETE FROM airline_staff WHERE license_num='$license_num' AND airline_name='$airline_name'";
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
						$sql = "UPDATE airline_staff SET position='$position', staff_name='$staff_name' WHERE license_num='$license_num' AND airline_name='$airline_name'";
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
	
			</div>
		<div class="master-table">

		<?php
			include("connect.php");

			$sql = "SELECT * FROM airplane_staff WHERE airline_name='$airline_name' ORDER BY license_num";
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

		</div>
	</div>
	
	</body>
</html>