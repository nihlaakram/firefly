<?php

//db connection
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
//sends button id
$serial = "DB266";

//get the location id
$sql1 = "SELECT * FROM button where serial='".$serial."'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
		$loc_id = $row["location_id"];
    
        //querry locationMap for beacon
        $sql = "SELECT * FROM locationmap where location_id='".$loc_id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                
            while($row = $result->fetch_assoc()) {
                $beacon =  $row["beacon_id"];
                echo "-------------------- ".$beacon;
                
                $sql = "SELECT * FROM salesassistant where current_beacon_id='".$beacon."'";
                $result2 = $conn->query($sql);

                if ($result2->num_rows > 0) {
		          // output data of each row
                    //use beacon and fetch the connected 
		          while($row = $result2->fetch_assoc()) {
	               echo "------------------  ".$row["id"];
		          }
	           } else {
		          echo "0 results";
                }
            }
	       
		
	      } else {
            //insert
            
        }
            /////////////
		}
		
	} else {

	}

$conn->close();

?>