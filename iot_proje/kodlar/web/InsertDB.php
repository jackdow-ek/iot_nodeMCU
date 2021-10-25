<?php

    $servername = "localhost";
    $username = "root";
    $password = "root";	
    $dbname = "nodemcu_temperature";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set('Europe/Istanbul');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    if(!empty($_POST['ldrvalue']))
    {
		$ldrvalue = $_POST['ldrvalue'];
	    $sql = "INSERT INTO nodemcu_temperature_table (Temperature, Date, Time) VALUES ('".$ldrvalue."', '".$d."', '".$t."')";

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$conn->close();
?>