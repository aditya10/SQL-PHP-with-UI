<html>
<head>
  <link rel="stylesheet" href="design.css">
</head>
    <body>
      <div class="wrapper">
        <div class="header">
          <h2>Airport Database</h2>
        </div>
        <div class="table">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "AirportSample";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $now = date("Y-m-d H:i:s");
        $sql = "SELECT flight_num, depcity, arrcity FROM Plane WHERE arrtime >'$now'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table><tr><th>Flight Num</th><th>Departure City</th><th>Arrival City</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["flight_num"]. "</td><td>" . $row["depcity"]. "</td><td>" . $row["arrcity"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
      </div>
    </div>
  </body>
</html>
