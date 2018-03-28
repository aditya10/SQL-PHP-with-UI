<html>
	<head>
        <title>Plane Information</title>
        <link rel="stylesheet" href="css/login.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <table>
                    <tr>
                        <td id="title"><h2>Airport Database</h2></td>
                    </tr>
                </table>
            </div>
		
		<?php

			if(isset($_GET['fl_no'])){
				$fl_no = $_GET['fl_no'];
				
				include("connect.php");

				$sql = "SELECT f.flight_num, p.airline_name, f.plane_num, f.depcity, f.arrcity, f.deptime, f.arrtime, f.gate, f.status, p.model, d.terminal_num, t.location FROM flight f, plane p, docked_at d, terminal t WHERE f.plane_num=p.plane_num AND f.flight_num=d.flight_num AND d.terminal_num=t.terminal_num AND f.flight_num='$fl_no'"; 
				
				$result = $conn->query($sql);

				if ($result->num_rows == 1) {
					// output data of each row
					echo "<h2>All the information about Flight ".$fl_no.":</h2><br><br>";
			
					$row = $result->fetch_assoc();
					
					echo "Airline Name: ".$row["airline_name"]."<br>";
					echo "Plane Code: ".$row["plane_num"]."<br>";
					echo "Departure City: ".$row["depcity"]."<br>";
					echo "Arrival City: ".$row["arrcity"]."<br>";
					echo "Departure Time: ".$row["deptime"]."<br>";
					echo "Arrival Time: ".$row["arrtime"]."<br>";
					echo "Gate: ".$row["gate"]."<br>";
					echo "Status: ".$row["status"]."<br>";
					echo "Plane Model: ".$row["model"]."<br>";
					echo "Terminal Number: ".$row["terminal_num"]."<br>";
					echo "Terminal Location: ".$row["location"]."<br>";
					
				} else {
					echo "Error in retrieving results";
				}
			} else{
				echo "error error";
			}
			
        ?>
			
		</div>
	</body>
</html>