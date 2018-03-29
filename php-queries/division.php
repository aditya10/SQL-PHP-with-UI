<html>
	<body>
		<?php
        $sql = "SELECT P.plane_num FROM Plane P, Flight F WHERE NOT EXISTS (SELECT T.terminal_num FROM Terminal T WHERE T.terminal_num NOT IN (SELECT D.terminal_num FROM docked_at D WHERE D.flight_num=F.flight_num)) AND P.plane_num=F.plane_num";
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
	</body>
</html>