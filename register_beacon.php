<?php

    require "db_create.php";

    //captue post
    $array =  json_decode(file_get_contents('php://input'), true);
    

    //get data from json
    $namespace = $array['namespace'];
    $instance = $array['instance'];
    $location_id = $array['location_id'];   
    file_put_contents('abc.txt',file_get_contents('php://input'),FILE_APPEND);
    file_put_contents('abc.txt',json_encode($array),FILE_APPEND);

    $namespace="edd1ebeac04e5defa017";
    $instance="64872c865aba";
    $location_id=145;
    /*
    Namespace: edd1ebeac04e5defa017
    Instance: 64872c865aba
    */
    //insert the stuoid beacon to the mighty table 
     $bs ="insert into beacon ( namespace, instance, location_id) values ('".$namespace."', '".$instance."', ".$location_id.")";
    if ($conn->query($bs) === TRUE) {
    //echo "Record updated successfully";
    } else {
       // echo "Error updating record: " . $conn->error;    
    }
   
    //get the beacon id of the newly added beacon
    
    $sql = "SELECT * FROM beacon where namespace='".$namespace."' and instance='".$instance."'";
	$result = $conn->query($sql);

    //////
     while($row = $result->fetch_assoc()) {
	if ($result->num_rows > 0) {
		$beacon = $row["id"];
        //check if the location id exist, id so update. Else create
        $sql1 = "SELECT * FROM locationmap where location_id='".$location_id."'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
		//update
            $bs ="update locationmap set beacon_id='".$beacon."' where location_id='".$location_id."'";
            if ($conn->query($bs) === TRUE) {
            } else {
            }
	   } else {
        //insert
            $bs ="insert into locationmap (location_id, beacon_id) values('".$location_id."', '".$beacon."')"; 
            if ($conn->query($bs) === TRUE) {
            } else {
            }
	   }
	} else {
  
	}
    }
    /////


    
    
    

    $conn->close();
?>


