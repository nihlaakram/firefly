<?php

    require "db_create.php";

    //captue post
    $array =  json_decode(file_get_contents('php://input'), true);
    

    //get data from json
    $serial = $array['serial'];
    $location_id = $array['location_id'];   
    file_put_contents('abc1.txt',file_get_contents('php://input'),FILE_APPEND);
    file_put_contents('abc1.txt',json_encode($array),FILE_APPEND);

    $serial = "DB_Shalu";
    $location_id=145;

    //insert the button to the mighty table 
     $bs ="insert into button ( serial, location_id) values (".$serial."', ".$location_id.")";
    if ($conn->query($bs) === TRUE) {
    //echo "Record updated successfully";
    } else {
       // echo "Error updating record: " . $conn->error;    
    }
   
    //get the beacon id of the newly added beacon
    
    $sql = "SELECT * FROM button where serial='".$serial."' and location_id='".$location_id."'";
	$result = $conn->query($sql);

    //////
   
        //check if the location id exist, id so update. Else create
        $sql1 = "SELECT * FROM locationmap where location_id='".$location_id."'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
		//update
            $bs ="update locationmap set button_serial='".$serial."' where location_id='".$location_id."'";
            if ($conn->query($bs) === TRUE) {
            } else {
            }
	   } else {
        //insert
            $bs ="insert into locationmap (location_id, button_serial) values('".$location_id."', '".$serial."')"; 
            if ($conn->query($bs) === TRUE) {
            } else {
            }
	   }
	
   
    /////


    
    
    

    $conn->close();
?>


