<html lang="en">
	<head>
        <title>Team 11 - CPSC 304 - Airport Admin</title>
        <link rel="stylesheet" href="css/admin.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
	<body>
		<div class="header">
			<table>
				<tr>
					<td id="title"><h2>Airport Database - Admin Center</h2></td>
				</tr>
			</table>
        </div>
	
	
	<div class="row" id="airport-staff">
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
	
			</div>
		<div class="master-table">

		<?php
			include("connect.php");

			$sql = "SELECT * FROM airport_staff ORDER BY license_num";
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
	<div class="row" id="department">
		<div class="master-form">
	
			<form action="" method="post">
				<label for="dept_type">Department:</label>
				<input type="text" name="dept_type" id="dept_type">
				
				<br><br>
				<label for="manager">Manager: </label>
				<input type="text" name="manager" id="manager"> (not required for searching/deleting)
				<br><br>
				
				<label for="traffic">Traffic: </label> 
				<input type="text" name="traffic" id="traffic"> (not required for searching/deleting)
				<br><br>

				<input type="submit" value="Add Department" name="submit_dept">
				<input type="submit" value="Search" name="search_dept">
				<input type="submit" value="Delete" name="delete_dept">
				<input type="submit" value="Update" name="update_dept">
			</form>
	
	
		<?php
		include("connect.php");
		session_start();

		if(isset($_POST['submit_dept'])) {
				// Escape user inputs for security
				$dept_type = mysqli_real_escape_string($conn, $_REQUEST['dept_type']);
				$manager = mysqli_real_escape_string($conn, $_REQUEST['manager']);
				$traffic = mysqli_real_escape_string($conn, $_REQUEST['traffic']);

			if($dept_type){
				// attempt insert query execution
				$sql = "INSERT INTO department VALUES ('$dept_type', '$manager', '$traffic')";
				if(mysqli_query($conn, $sql)){
					echo "Record added successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
			} else{
				echo "Error: invalid department entered.";
			}
		}

		if(isset($_POST['search_dept'])) {
				// Escape user inputs for security
				$dept_type = mysqli_real_escape_string($conn, $_REQUEST['dept_type']);

			$sql = "SELECT * FROM department WHERE dept_type='$dept_type'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><tr><th>Department</th><th>Manager</th><th>Traffic</th></tr>";
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . $row["dept_type"]. "</td><td>" . $row["manager"]. "</td><td>" . $row["traffic"]. "</td>";
						echo "</tr>";
					}
					echo "</table>";
				} else {
					echo "0 results";
				}
		}

		if(isset($_POST['delete_dept'])) {
				// Escape user inputs for security
				$dept_type = mysqli_real_escape_string($conn, $_REQUEST['dept_type']);

			if($dept_type){
				// attempt insert query execution
				$sql = "DELETE FROM department WHERE dept_type='$dept_type'";
				if(mysqli_query($conn, $sql)){
					echo "Record deleted successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
			} else{
				echo "Error: invalid department entered.";
			}
		}

		if(isset($_POST['update_dept'])) {
				// Escape user inputs for security
				$dept_type = mysqli_real_escape_string($conn, $_REQUEST['dept_type']);
				$manager = mysqli_real_escape_string($conn, $_REQUEST['manager']);
				$traffic = mysqli_real_escape_string($conn, $_REQUEST['traffic']);

			if($dept_type){
				// attempt insert query execution
				$sql = "UPDATE department SET traffic='$traffic', manager='$manager' WHERE dept_type='$dept_type'";
				if(mysqli_query($conn, $sql)){
					echo "Record updated successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
			} else{
				echo "Error: invalid department entered.";
			}
		}

		// close connection
		mysqli_close($conn);
		?>
	
		</div>
		<div class="master-table">

			<?php
				include("connect.php");

				$sql = "SELECT * FROM department ORDER BY traffic DESC"; //WHERE arrtime >'$now'
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><tr><th>Department</th><th>Manager</th><th>Traffic</th></tr>";
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . $row["dept_type"]. "</td><td>" . $row["manager"]. "</td><td>" . $row["traffic"]. "</td>";
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
	<div id="row">
		<div class="master-table">
			<h3 align='center'>Collation of staff working in departments</h3>
        <?php
        	include("connect.php");

       		$sql = "SELECT a.license_num, a.position, a.staff_name, d.dept_type, d.manager, d.traffic FROM airport_staff a, department d, works_in w WHERE a.license_num=w.license_num AND d.dept_type=w.dept_type ORDER BY a.license_num"; 
		$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table>
					<tr>
					<th>License Num</th>
					<th>Position</th>
					<th>Staff Name</th>
					<th>Department</th>
					<th>Manager</th>
					<th>Traffic</th>
					</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["license_num"]. "</td>";
				echo "<td>" . $row["position"]. "</td>";
				echo "<td>" . $row["staff_name"]. "</td>";
				echo "<td>" . $row["dept_type"]. "</td>";
				echo "<td>" . $row["manager"]. "</td>";
				echo "<td>" . $row["traffic"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
		</div>
	</div>
	<div id="row">
		<div class="master-table">
			<h3 align='center'>Number of staff in each airline</h3>
		<?php
			include("connect.php");
        $sql = "SELECT A.airline_name, COUNT(B.license_num) FROM airline A, airplane_staff B WHERE A.airline_name = B.airline_name GROUP BY A.airline_name";
		$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table><tr><th>Airline Name</th><th>Num of Employees</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["airline_name"]. "</td><td>" . $row["COUNT(B.license_num)"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
		</div>
	</div>
	<div id="row">
			<div class="master-table">
			<h3 align='center'>Planes which have been docked at every terminal</h3>
			<?php
        $sql = "SELECT P.plane_num FROM plane P, flight F WHERE NOT EXISTS (SELECT T.terminal_num FROM terminal T WHERE T.terminal_num NOT IN (SELECT D.terminal_num FROM docked_at D WHERE D.flight_num=F.flight_num)) AND P.plane_num=F.plane_num";
		$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table><tr><th>Plane Num</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["plane_num"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
		</div>
	</div>
</body>
</html>