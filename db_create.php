<?php

//database related shit
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "firefly";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "<script>
                alert(\"Connection Error to db\");
              </script>";

	}


?>