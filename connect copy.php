<?php
       $servername = "localhost:3306";
        $username = "qleawyke_airportuser";
        $password = "1rrTtqJ^Vr*E";
        $dbname = "qleawyke_AirportDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
 ?>