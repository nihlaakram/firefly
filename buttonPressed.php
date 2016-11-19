<?php

//db connection
require "db_create.php";

//sends button id
$array =  json_decode(file_get_contents('php://input'), true);
$event = $array['event_name'];
$serial = $array['mac'];

$serial = "DB266";
$event = "PRESSED";
    file_put_contents('abc2.txt',file_get_contents('php://input'),FILE_APPEND);
    file_put_contents('abc2.txt',json_encode($array),FILE_APPEND);
    
    if ($event=='PRESSED') {
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
                
                $sql = "SELECT * FROM salesassistant where current_beacon_id='".$beacon."'";
                $result2 = $conn->query($sql);
                $myfile = fopen("assitfile.txt", "wb") or die("Unable to open file!");
                if ($result2->num_rows > 0) {
		          // output data of each row
                    //use beacon and fetch the connected 
		          while($row = $result2->fetch_assoc()) {
                       // $text = $row["id"]."\n";
                        echo $row["id"];
                        fwrite($myfile, $row["id"]. "\r\n");
                        require "connect.php";
                       
		          }
	           } else {
		          echo "0 results";
                }
                 fclose($myfile);
            }
	       
		
	      } else {
            //insert
            
        }
            /////////////
		}
		
	} else {

	}

	
	}else{

		
		
	}


$conn->close();

?>