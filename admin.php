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
							echo "Any data related to $license_num has been deleted successfully.";
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
					<p>
						<label for="airline_name">Airline Name:</label> 
						<input type="text" name="airline_name" id="airline_name"> (not required for searching/deleting)
					</p>
					<input type="submit" value="Add Person" name="submit_airstaff">
					<input type="submit" value="Search" name="search_airstaff">
					<input type="submit" value="Delete" name="delete_airstaff">
					<input type="submit" value="Update" name="update_airstaff">
	
				</form>
	
	
				<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_airstaff'])) {
						// Escape user inputs for security
						$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);
						$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
						$staff_name = mysqli_real_escape_string($conn, $_REQUEST['staff_name']);
						$airline_name = mysqli_real_escape_string($conn, $_REQUEST['airline_name']);

					if($license_num>0){
						// attempt insert query execution
						$sql = "INSERT INTO airplane_staff VALUES ('$license_num', '$position', '$staff_name', '$airline_name'')";
						if(mysqli_query($conn, $sql)){
							echo "Records added successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid license number entered.";
					}
				}

				if(isset($_POST['search_airstaff'])) {
						// Escape user inputs for security
						$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);

					$sql = "SELECT * FROM airplane_staff WHERE license_num='$license_num'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						echo "<table><tr><th>License No</th><th>Position</th><th>Name</th><th>Airline Name</th></tr>";
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["license_num"]. "</td><td>" . $row["position"]. "</td><td>". $row["staff_name"]."</td><td>". $row["airline_name"]."</td>";
							echo "</tr>";
						}
						echo "</table>";
					} else {
						echo "0 results";
					}
				}

				if(isset($_POST['delete_airstaff'])) {
						// Escape user inputs for security
						$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);

					if($license_num>0){
						// attempt insert query execution
						$sql = "DELETE FROM airplane_staff WHERE license_num='$license_num'";
						if(mysqli_query($conn, $sql)){
							echo "Any data related to $license_num has been deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid license number entered.";
					}
				}

				if(isset($_POST['update_airstaff'])) {
						// Escape user inputs for security
						$license_num = mysqli_real_escape_string($conn, $_REQUEST['license_num']);
						$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
						$staff_name = mysqli_real_escape_string($conn, $_REQUEST['staff_name']);
						$airline_name = mysqli_real_escape_string($conn, $_REQUEST['airline_name']);

					if($license_num>0){
						// attempt insert query execution
						$sql = "UPDATE airplane_staff SET position='$position', staff_name='$staff_name', airline_name='$airline_name' WHERE license_num='$license_num'";
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

			$sql = "SELECT * FROM airplane_staff ORDER BY license_num";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo "<table><tr><th>License No</th><th>Position</th><th>Name</th><th>Airline Name</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["license_num"]. "</td><td>" . $row["position"]. "</td><td>" . $row["staff_name"]."</td><td>" . $row["airline_name"]. "</td>";
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
					echo "Any data related to $dept_type has been deleted successfully.";
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
			<h3>Division query</h3>
			<?php
			//HUJH
				echo "Finds planes which have been docked at every terminal.";
				$sql = "SELECT P.plane_num FROM plane P, flight F WHERE NOT EXISTS (SELECT T.terminal_num FROM terminal T WHERE T.terminal_num NOT IN (SELECT D.terminal_num FROM docked_at D WHERE D.flight_num=F.flight_num)) AND P.plane_num=F.plane_num";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<table><tr><th>Plane No</th></tr>";
					while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["plane_num"]. "</td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
						echo "0 results";
				}
			//NJKH
			?>
		</div>
	</div>
	<div id="row">
		<div class="master-table">
			<h3>Aggregation query</h3>
		<?php
		//HUJH
		echo "Finds the number of staff in each airline:";
		$sql = "SELECT A.airline_name, COUNT(B.license_num) AS 'Number' FROM airline A, airplane_staff B WHERE A.airline_name = B.airline_name GROUP BY A.airline_name";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Airline name</th><th>Number</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["airline_name"]. "</td><td>" . $row["Number"]. "</td>";
					echo "</tr>";
			}
			echo "</table>";
		} else {
				echo "0 results";
		}
		//NJKH
		?>
			<br>
			<br>
			<?php
		//HUJH
		echo "Finds the number of delayed flights per airline:";
		$sql = "SELECT A.airline_name, COUNT(F.status) AS 'num-delayed' FROM airline A, flight F, plane P WHERE A.airline_name = P.airline_name AND P.plane_num = F.plane_num AND F.status='Delayed' GROUP BY A.airline_name";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Airline name</th><th>Delayed</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["airline_name"]. "</td><td>" . $row["num-delayed"]. "</td>";
					echo "</tr>";
			}
			echo "</table>";
		} else {
				echo "0 results";
		}
		//NJKH
		?>
		</div>
	</div>
	<div id="row">
		<div class="master-table">
		<h3>Nested Aggregation with Group By</h3>
		<?php
	//HUJH
		echo "Finds the average of plane capacities of each airline and then finds the maximum/minimum across all of these averages:";
		$sql = "SELECT DISTINCT Helper.avecap FROM (SELECT P.airline_name, AVG(P.capacity) avecap FROM plane P GROUP BY P.airline_name) as Helper WHERE Helper.avecap = (SELECT MIN(avecap) FROM (SELECT P.airline_name, AVG(P.capacity) AS avecap FROM plane P GROUP BY P.airline_name) as temp)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Minimum</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["avecap"]. "</td>";
					echo "</tr>";
			}
			echo "</table>";
		} else {
				echo "0 results";
		}
			
		$sql = "SELECT DISTINCT Helper.avecap FROM (SELECT P.airline_name, AVG(P.capacity) avecap FROM plane P GROUP BY P.airline_name) as Helper WHERE Helper.avecap = (SELECT MAX(avecap) FROM (SELECT P.airline_name, AVG(P.capacity) AS avecap FROM plane P GROUP BY P.airline_name) as temp)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Maximum</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["avecap"]. "</td>";
					echo "</tr>";
			}
			echo "</table>";
		} else {
				echo "0 results";
		}

		?>
		</div>
		
		
		<div class="master-table">
		<h3>Nested Aggregation with Group By</h3>
		<?php
	//HUJH
		echo "Finds the sum of plane capacities of each airline and then finds the maximum/minimum across all of these sums:";
		$sql = "SELECT DISTINCT Helper.sumcap FROM (SELECT P.airline_name, SUM(P.capacity) sumcap FROM plane P GROUP BY P.airline_name) as Helper WHERE Helper.sumcap = (SELECT MIN(sumcap) FROM (SELECT P.airline_name, SUM(P.capacity) AS sumcap FROM plane P GROUP BY P.airline_name) as temp)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Minimum</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["sumcap"]. "</td>";
					echo "</tr>";
			}
			echo "</table>";
		} else {
				echo "0 results";
		}
			
		$sql = "SELECT DISTINCT Helper.sumcap FROM (SELECT P.airline_name, SUM(P.capacity) sumcap FROM plane P GROUP BY P.airline_name) as Helper WHERE Helper.sumcap = (SELECT MAX(sumcap) FROM (SELECT P.airline_name, SUM(P.capacity) AS sumcap FROM plane P GROUP BY P.airline_name) as temp)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Maximum</th></tr>";
			while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["sumcap"]. "</td>";
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