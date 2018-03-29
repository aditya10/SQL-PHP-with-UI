<html>
	<head>
        <title>Team 11 - CPSC 304 - Airport Admin</title>
        <link rel="stylesheet" href="css/airline.css">
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

		
		<div class="row" id="plane">
		<div class="master-form">
				<form action="" method="post">
					<p>
						<label for="plane_num">Plane Num:</label>
						<input type="text" name="plane_num" id="plane_num">
					</p>
					<p>
						<label for="capacity">capacity: </label>
						<input type="text" name="capacity" id="capacity"> Constraint: Must be between 1 and 1000.(not required for searching/deleting)
					</p>
					<p>
						<label for="model">Model: </label> 
						<input type="text" name="model" id="model"> (not required for searching/deleting)
					</p>
					<input type="submit" value="Add Plane" name="submit_plane">
					<input type="submit" value="Search" name="search_plane">
					<input type="submit" value="Delete" name="delete_plane">
					<input type="submit" value="Update" name="update_plane">
	
				</form>
	
	
				<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_plane'])) {
						// Escape user inputs for security
						$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);
						$capacity = mysqli_real_escape_string($conn, $_REQUEST['capacity']);
						$model= mysqli_real_escape_string($conn, $_REQUEST['model']);

					if($plane_num>0){
						if($capacity>0 && $capacity<1001){
							// attempt insert query execution
							$sql = "INSERT INTO plane VALUES ('$plane_num', '$capacity', '$model', '$airline_name')";
							if(mysqli_query($conn, $sql)){
								echo "Records added successfully.";
							} else{
								echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
							}
						} else{
							echo "Error: capacity is not between 1 and 1000.";
						}
					} else{
						echo "Error: Please enter a unique integer plane number.";
					}
				}

				if(isset($_POST['search_plane'])) {
						// Escape user inputs for security
						$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);

					$sql = "SELECT * FROM plane WHERE plane_num='$plane_num' AND airline_name='$airline_name'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						echo "<table><tr><th>Plane No</th><th>Capacity</th><th>Model</th><th>Airline</th></tr>";
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["plane_num"]. "</td><td>" . $row["capacity"]. "</td><td>" . $row["model"]."</td><td>" . $row["airline_name"]. "</td>";
							echo "</tr>";
						}
						echo "</table>";
					} else {
						echo "0 results";
					}
				}

				if(isset($_POST['delete_plane'])) {
						// Escape user inputs for security
						$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);

					if($plane_num>0){
						// attempt insert query execution
						$sql = "DELETE FROM plane WHERE plane_num='$plane_num' AND airline_name='$airline_name'";
						if(mysqli_query($conn, $sql)){
							echo "Record deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid plane number entered.";
					}
				}

				if(isset($_POST['update_plane'])) {
						// Escape user inputs for security
						$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);
						$capacity = mysqli_real_escape_string($conn, $_REQUEST['capacity']);
						$model= mysqli_real_escape_string($conn, $_REQUEST['model']);

					if($plane_num>0){
						// attempt insert query execution
						$sql = "UPDATE plane SET capacity='$capacity', model='$model' WHERE plane_num='$plane_num' AND airline_name='$airline_name'";
						if(mysqli_query($conn, $sql)){
							echo "Record updated successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid plane number entered.";
					}
				}

				// close connection
				mysqli_close($conn);
				?>
	
			</div>
		<div class="master-table">

		<?php
			include("connect.php");

			$sql = "SELECT * FROM plane WHERE airline_name='$airline_name' ORDER BY plane_num";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo "<table><tr><th>Plane No</th><th>Capacity</th><th>Model</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["plane_num"]. "</td><td>" . $row["capacity"]. "</td><td>" . $row["model"]. "</td>";
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
	
		<div class="row" id="flight">
		<div class="master-form">
				<form action="" method="post">
					<p>
						<label for="flight_num">Flight Num:</label>
						<input type="text" name="flight_num" id="flight_num">
					</p>
					<p>
						<label for="plane_num">Plane Num: </label>
						<input type="text" name="plane_num" id="plane_num"> (not required for searching/deleting)
					</p>
					<p>
						<label for="depcity">Departure City: </label> 
						<input type="text" name="depcity" id="depcity"> (not required for searching/deleting)
					</p>
					<p>
						<label for="arrcity">Arrival City: </label> 
						<input type="text" name="arrcity" id="arrcity"> (not required for searching/deleting)
					</p>
					<p>
						<label for="deptime">Departure Time: </label> 
						<input type="text" name="deptime" id="deptime"> (not required for searching/deleting)
					</p>
					<p>
						<label for="arrtime">Arrival Time: </label> 
						<input type="text" name="arrtime" id="arrtime"> (not required for searching/deleting)
					</p>
					<p>
						<label for="gate">Gate: </label> 
						<input type="text" name="gate" id="gate"> (not required for searching/deleting)
					</p>
					<p>
						<label for="passengers">Passengers: </label> 
						<input type="text" name="passengers" id="passengers"> (not required for searching/deleting)
					</p>
					<p>
						<label for="status">Status: </label> 
						<input type="text" name="status" id="status"> (not required for searching/deleting)
					</p>
					<p>
						<label for="terminal_num">Terminal: </label> 
						<input type="text" name="terminal_num" id="terminal_num"> (Necessary for insertion. Please use a terminal number that exisits)
					</p>
					<input type="submit" value="Add Flight" name="submit_flight"><br>
					<br>
					<input type="checkbox" name="plane_num-box"><label class="check" for="checkbox">Plane Num</label>
					<input type="checkbox" name="depcity-box"><label class="check" for="checkbox">Dep City</label>
					<input type="checkbox" name="arrcity-box"><label class="check" for="checkbox">Arr City</label>
					<input type="checkbox" name="deptime-box"><label class="check" for="checkbox">Dep Time</label>
					<input type="checkbox" name="arrtime-box"><label class="check" for="checkbox">Arr Time</label>
					<input type="checkbox" name="gate-box"><label class="check" for="checkbox">Gate</label>
					<input type="checkbox" name="passengers-box"><label class="check" for="checkbox">Passengers</label>
					<input type="checkbox" name="status-box"><label class="check" for="checkbox">Status</label>
					<br>
					<input type="submit" value="Search" name="search_flight"><br><br>
					
					<input type="submit" value="Delete" name="delete_flight"><br><br>
					
					<input type="submit" value="Update" name="update_flight">
	
				</form>
	
	
				<?php
				include("connect.php");
				session_start();

				if(isset($_POST['submit_flight'])) {
					
						$flight_num = mysqli_real_escape_string($conn, $_REQUEST['flight_num']);
						$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);
						
						$sql = "SELECT * FROM plane WHERE plane_num='$plane_num' AND airline_name='$airline_name'";
						$result = $conn->query($sql);

						if ($result->num_rows == 1){
							$depcity= mysqli_real_escape_string($conn, $_REQUEST['depcity']);
							$arrcity = mysqli_real_escape_string($conn, $_REQUEST['arrcity']);
							$deptime = mysqli_real_escape_string($conn, $_REQUEST['deptime']);
							$arrtime= mysqli_real_escape_string($conn, $_REQUEST['arrtime']);
							$gate = mysqli_real_escape_string($conn, $_REQUEST['gate']);
							$passengers = mysqli_real_escape_string($conn, $_REQUEST['passengers']);
							$status= mysqli_real_escape_string($conn, $_REQUEST['status']);
							$terminal_num = mysqli_real_escape_string($conn, $_REQUEST['terminal_num']);
							
						if($flight_num>0 && $terminal_num>0){
							// attempt insert query execution
							$sql = "INSERT INTO flight VALUES ('$flight_num', '$plane_num', '$depcity', '$arrcity', '$deptime', '$arrtime', '$gate', '$passengers', '$status')";
							if(mysqli_query($conn, $sql)){
								$sql = "INSERT INTO docked_at VALUES ('$flight_num', '$terminal_num')";
								if(mysqli_query($conn, $sql)){
									echo "Records added successfully.";
								} else{
									echo "ERROR: Could not execute docked_at $sql. " . mysqli_error($conn);
								}
							} else{
								echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
							}
						} else{
							echo "Error: Please enter a unique integer plane number.";
						}
						} else{
							echo "Error: Please ensure plane number exists.";
						}
						
				}

				if(isset($_POST['search_flight'])) {
					
					
					
					// Escape user inputs for security
					$flight_num = mysqli_real_escape_string($conn, $_REQUEST['flight_num']);
					$search_str = "flight_num";
					if(isset($_POST['plane_num-box'])){
						$search_str .= ", plane_num";
					}
					if(isset($_POST['depcity-box'])){
						$search_str .= ", depcity";
					}
					if(isset($_POST['arrcity-box'])){
						$search_str .= ", arrcity";
					}
					if(isset($_POST['deptime-box'])){
						$search_str .= ", deptime";
					}
					if(isset($_POST['arrtime-box'])){
						$search_str .= ", arrtime";
					}
					if(isset($_POST['gate-box'])){
						$search_str .= ", gate";
					}
					if(isset($_POST['passengers-box'])){
						$search_str .= ", passengers";
					}
					if(isset($_POST['status-box'])){
						$search_str .= ", status";
					}
					
					
					$sql = "SELECT $search_str FROM flight WHERE flight_num='$flight_num'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
	
						while($row = $result->fetch_assoc()) {
							
							echo "Flight No: ".$row["flight_num"]."<br>";
							
							if(isset($_POST['plane_num-box'])){
								echo "Plane No: ".$row["plane_num"]."<br>";
							}
							if(isset($_POST['depcity-box'])){
								echo "Dep City: ".$row["depcity"]."<br>";
							}
							if(isset($_POST['arrcity-box'])){
								echo "Arr City: ".$row["arrcity"]."<br>";
							}
							if(isset($_POST['deptime-box'])){
								echo "Dep Time: ".$row["deptime"]."<br>";
							}
							if(isset($_POST['arrtime-box'])){
								echo "Arr Time: ".$row["arrtime"]."<br>";
							}
							if(isset($_POST['gate-box'])){
								echo "Gate: ".$row["gate"]."<br>";
							}
							if(isset($_POST['passengers-box'])){
								echo "Passengers: ".$row["passengers"]."<br>";
							}
							if(isset($_POST['status-box'])){
								echo "Status: ".$row["status"]."<br>";
							}
						}
				
					} else {
						echo "0 results";
					}
				}

				if(isset($_POST['delete_flight'])) {
						// Escape user inputs for security
						$flight_num = mysqli_real_escape_string($conn, $_REQUEST['flight_num']);

					if($flight_num>0){
						// attempt insert query execution
						$sql = "DELETE FROM flight WHERE flight_num='$flight_num'";
						if(mysqli_query($conn, $sql)){
							echo "Record deleted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid flight number entered.";
					}
				}

				if(isset($_POST['update_flight'])) {
					
					$flight_num = mysqli_real_escape_string($conn, $_REQUEST['flight_num']);
					$plane_num = mysqli_real_escape_string($conn, $_REQUEST['plane_num']);
					$depcity= mysqli_real_escape_string($conn, $_REQUEST['depcity']);
					$arrcity = mysqli_real_escape_string($conn, $_REQUEST['arrcity']);
					$deptime = mysqli_real_escape_string($conn, $_REQUEST['deptime']);
					$arrtime= mysqli_real_escape_string($conn, $_REQUEST['arrtime']);
					$gate = mysqli_real_escape_string($conn, $_REQUEST['gate']);
					$passengers = mysqli_real_escape_string($conn, $_REQUEST['passengers']);
					$status= mysqli_real_escape_string($conn, $_REQUEST['status']);
					
			
					function create_query($plane_num, $depcity, $arrcity, $deptime, $arrtime, $gate, $passengers, $status) {
					  $options = array(
						  'plane_num' => $plane_num,
						  'depcity' => $depcity,
						  'arrcity' => $arrcity,
						  'deptime' => $deptime,
						  'arrtime' => $arrtime,
						  'gate' => $gate,
						  'passengers' => $passengers,
						  'status' => $status
						);
					  $cond = '';
					  $noopt = true;
					  foreach ($options as $column => $value) {
						if ($value) {
						  $noopt = false;
						  if ($cond != '') $cond .= ' , ';
						  $cond .= "$column='$value'";
						  }
						}
					  return $noopt ? false : $cond;
					 }
						

					if($flight_num>0){
						// attempt insert query execution
						$sql = "UPDATE flight SET ".create_query($plane_num, $depcity, $arrcity, $deptime, $arrtime, $gate, $passengers, $status)." WHERE flight_num='$flight_num'"; 
						if(mysqli_query($conn, $sql)){
							echo "Record updated successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
						}
					} else{
						echo "Error: invalid flight number entered.";
					}
				}

				// close connection
				mysqli_close($conn);
				?>
	
			</div>
		<div class="master-table">

		<?php
			include("connect.php");

			$sql = "SELECT f.flight_num, f.plane_num, f.depcity, f.arrcity, f.deptime, f.arrtime, f.gate, f.passengers, f.status, d.terminal_num FROM flight f, docked_at d, plane p WHERE f.flight_num=d.flight_num AND f.plane_num=p.plane_num AND p.airline_name='$airline_name'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo "<table><tr><th>Flight Num</th><th>Plane Num</th><th>Departure City</th><th>Arrival City</th><th>Dep Time</th><th>Arrival Time</th><th>Gate</th><th>Passengers</th><th>Status</th><th>Terminal</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td><a href='plane-info.php?fl_no=".$row["flight_num"]."'>" . $row["flight_num"]. "</a></td>";
					echo "<td>" . $row["plane_num"]. "</td>";
					echo "<td>" . $row["depcity"]. "</td>";
					echo "<td>" . $row["arrcity"]. "</td>";
					echo "<td>" . $row["deptime"]. "</td>";
					echo "<td>" . $row["arrtime"]. "</td>";
					echo "<td>" . $row["gate"]. "</td>";
					echo "<td>" . $row["passengers"]. "</td>";
					echo "<td>" . $row["status"]. "</td>";
					echo "<td>" . $row["terminal_num"]. "</td>";
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