<?php

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

    //fetch the post request, extract parameters from the request
    $namespace = $_POST["namespace"];
    $instance = $_POST["instance"];
    $id= $_POST["id"];

    //echo "Test ".$namespace." dcsd ".$instance." csc ".$id;

    //get the beacon id
    //update db
    $sql1 = "SELECT id FROM beacon where namespace='".$namespace."' and instance='".$instance."'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
		$beacon = $row["id"];
        
            //////////
            //update db
        $sql = "SELECT * FROM salesassistant where id='".$id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
	       //update
            $bs ="update salesassistant set current_beacon_id='".$beacon."' where id='".$id."'";
            if ($conn->query($bs) === TRUE) {
            } else {
            }
		
	      } else {
            //insert
            $bs ="insert into salesassistant (id, current_beacon_id) values ('".$id."', '".$beacon."')";
            if ($conn->query($bs) === TRUE) {
            } else {
            }
        }
            /////////////
		}
		
	} else {

	}


    $conn->close();

?>