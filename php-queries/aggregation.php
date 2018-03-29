<html>
	<body>
		<?php
        $sql = "SELECT A.airline_name, COUNT(B.license_num) FROM Airline A, Airplane_Staff B WHERE A.airline_name = B.airline_name GROUP BY A.airline_name";
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
	</body>
</html>