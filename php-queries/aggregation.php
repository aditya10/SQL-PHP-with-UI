<html>
	<body>
		<div class="table">
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
		<div class="table">
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
		  </div>
		  
		<div class="table">
			<h3>Nested Aggregation with Group By</h3>
		<?php
	//HUJH
		echo "Finds the average of plane capacities of each airline and then finds the maximum/minimum across all of these averages:";
		$sql = "SELECT Helper.avecap FROM (SELECT P.airline_name, AVG(P.capacity) avecap FROM Plane P GROUP BY P.airline_name) as Helper WHERE Helper.avecap = (SELECT MIN(avecap) FROM (SELECT P.airline_name, AVG(P.capacity) AS avecap FROM Plane P GROUP BY P.airline_name) as temp)";
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
			
		$sql = "SELECT Helper.avecap FROM (SELECT P.airline_name, AVG(P.capacity) avecap FROM Plane P GROUP BY P.airline_name) as Helper WHERE Helper.avecap = (SELECT MIN(avecap) FROM (SELECT P.airline_name, AVG(P.capacity) AS avecap FROM Plane P GROUP BY P.airline_name) as temp)";
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

		?>
			<?php
		  $conn->close();
        ?>

			</div>

	</body>
</html>