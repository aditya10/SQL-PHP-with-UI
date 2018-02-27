<html>
    <body>
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
            while($row = $result->fetch_assoc()) {
                echo "Fl No: " . $row["flight_num"]. " - DepCity: " . $row["depcity"]. " - ArrCity: " . $row["arrcity"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </body>
</html>
