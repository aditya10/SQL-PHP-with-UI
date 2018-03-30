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
					<td id="home"><a href="index.php">Home</a></td>
				</tr>
			</table>
        </div>
	
	
	<div class="row" id="airport-staff">
		<h3>Airport Staff Management</h3>
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
	<div class="row" id="airplane-staff">
		<h3>Airplane Staff Management</h3>
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
						$sql = "INSERT INTO airplane_staff VALUES ('$license_num', '$position', '$staff_name', '$airline_name')";
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
		<h3>Airport Departments Management</h3>
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
	<div id="staff-dept">
		
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
		<br>
		<hr>
		<br>
	<div class="row" id="division">
		<h3>Airplane and Alliance Management</h3>
		<div class="master-form">
			<form action="" method="post">
					<p>
						<label for="airline_name">Airline Name:</label>
						<input type="text" name="airline_name" id="airline_name">
					</p>
					<input type="submit" value="Add Airline" name="submit_airline">
					<input type="submit" value="Delete Airline" name="delete_airline">
			</form>
			
			<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_airline'])) {
						// Escape user inputs for security
						$airline_name = mysqli_real_escape_string($conn, $_REQUEST['airline_name']);

					if($airline_name){
						// attempt insert query execution
						$sql = "INSERT INTO airline VALUES ('$airline_name')";
						if(mysqli_query($conn, $sql)){
							echo "Records added successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Airline Name entered.";
					}
				}

				if(isset($_POST['delete_airline'])) {
						// Escape user inputs for security
						$airline_name = mysqli_real_escape_string($conn, $_REQUEST['airline_name']);

					if($airline_name){
						// attempt insert query execution
						$sql = "DELETE FROM airline WHERE airline_name='$airline_name'";
						if(mysqli_query($conn, $sql)){
							echo "$airline_name has been deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Airline Name entered.";
					}
				}
				// close connection
				mysqli_close($conn);
				?>
			
			<form action="" method="post">
					<p>
						<label for="alliance_name">Alliance Name:</label>
						<input type="text" name="alliance_name" id="alliance_name">
					</p>
					<input type="submit" value="Add Alliance" name="submit_alliance">
					<input type="submit" value="Delete Alliance" name="delete_alliance">
			</form>
			
			<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_alliance'])) {
						// Escape user inputs for security
						$alliance_name = mysqli_real_escape_string($conn, $_REQUEST['alliance_name']);

					if($alliance_name){
						// attempt insert query execution
						$sql = "INSERT INTO alliance VALUES ('$alliance_name')";
						if(mysqli_query($conn, $sql)){
							echo "Records added successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Alliance Name entered.";
					}
				}

				if(isset($_POST['delete_alliance'])) {
						// Escape user inputs for security
						$alliance_name = mysqli_real_escape_string($conn, $_REQUEST['alliance_name']);

					if($alliance_name){
						// attempt insert query execution
						$sql = "DELETE FROM alliance WHERE alliance_name='$alliance_name'";
						if(mysqli_query($conn, $sql)){
							echo "$alliance_name has been deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Alliance Name entered.";
					}
				}
				// close connection
				mysqli_close($conn);
				?>
			
			<form action="" method="post">
					<p>
						<label for="alliance_num">Alliance Number:</label>
						<input type="text" name="alliance_num" id="alliance_num">
					</p>
					<p>
						<label for="alliance_name">Alliance Name:</label>
						<input type="text" name="alliance_name" id="alliance_name">
					</p>
					<p>
						<label for="airline_name">Airline Name:</label>
						<input type="text" name="airline_name" id="airline_name">
					</p>
					<input type="submit" value="Add Airline-Alliance" name="submit_all">
					<input type="submit" value="Delete Airline-Alliance" name="delete_all">
			</form>
			
			<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_all'])) {
						// Escape user inputs for security
					$alliance_num = mysqli_real_escape_string($conn, $_REQUEST['alliance_num']);
					$alliance_name = mysqli_real_escape_string($conn, $_REQUEST['alliance_name']);
					$airline_name = mysqli_real_escape_string($conn, $_REQUEST['airline_name']);

					if($alliance_num>0 && $alliance_name && $airline_name){
						// attempt insert query execution
						$sql = "INSERT INTO airline_alliance VALUES ('$alliance_num', '$alliance_name', '$airline_name')";
						if(mysqli_query($conn, $sql)){
							echo "Records added successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Alliance Num, Airline or Alliance Name entered.";
					}
				}

				if(isset($_POST['delete_all'])) {
						// Escape user inputs for security
						$alliance_num = mysqli_real_escape_string($conn, $_REQUEST['alliance_num']);

					if($alliance_num>0){
						// attempt insert query execution
						$sql = "DELETE FROM airline_alliance WHERE alliance_num='$alliance_num'";
						if(mysqli_query($conn, $sql)){
							echo "Alliance number $alliance_num has been deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid Alliance Number entered.";
					}
				}
				// close connection
				mysqli_close($conn);
				?>
			
		</div>
		<div class="master-table">
			<h3>Airlines</h3>
			<?php
			include("connect.php");
				session_start();
				$sql = "SELECT * FROM airline";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<table><tr><th>Airline Name</th></tr>";
					while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["airline_name"]. "</td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
						echo "0 results";
				}
			?>
			<h3>Alliances</h3>
			<?php
			include("connect.php");
				session_start();
				$sql = "SELECT * FROM alliance";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<table><tr><th>Alliance Name</th></tr>";
					while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["alliance_name"]. "</td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
						echo "0 results";
				}
			?>
			<h3>Airlines and Alliances</h3>
			<?php
			include("connect.php");
				session_start();
				$sql = "SELECT * FROM airline_alliance";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<table><tr><th>Alliance Num</th><th>Alliance Name</th><th>Airline Name</th></tr>";
					while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["alliance_num"]. "</td>";
							echo "<td>" . $row["alliance_name"]. "</td>";
							echo "<td>" . $row["airline_name"]. "</td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
						echo "0 results";
				}
			?>
			<h3>Airlines and Alliances</h3>
			<?php
			include("connect.php");
				session_start();
				echo "Division Query: Airlines that participate in all Alliances<br>";
				$sql = "SELECT A.airline_name FROM airline A WHERE NOT EXISTS (SELECT AL.alliance_name FROM alliance AL WHERE AL.alliance_name NOT IN (SELECT AA.alliance_name FROM airline_alliance AA WHERE AA.airline_name= A.airline_name))";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<table><tr><th>Airline Name</th></tr>";
					while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["airline_name"]. "</td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
						echo "0 results";
				}
			?>
			<br>
			<br>
		</div>
	</div>
		
	<div class="row2">
		<br>
		<hr>
		<br>
		<h3>Aggregation query</h3>
		<div class="master-table">
		<?php
			include("connect.php");
				session_start();
		echo "Finds the number of staff in each airline:<br>";
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

		?>
			<br>
			<br>
			<?php
			include("connect.php");
				session_start();

		echo "Finds the number of delayed flights per airline:<br>";
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
	<div class="row2">
		<h3>Nested Aggregation with Group By</h3>
		<div class="master-table">
		<?php
			include("connect.php");
				session_start();
		echo "Finds the average of plane capacities of each airline and then finds the maximum/minimum across all of these averages:<br>";
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
		
		<br>
		<br>
		<div class="master-table">
		<?php
			include("connect.php");
				session_start();
		echo "Finds the sum of plane capacities of each airline and then finds the maximum/minimum across all of these sums:<br>";
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