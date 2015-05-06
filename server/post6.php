<?php
$target_dir = "/home/pi/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file";
    }


try {
    $uncompressed = new PharData($target_file);
    $uncompressed->extractTo($target_dir); // extract all files
     echo "File  uncompressed $uncompressed";
} catch (Exception $e) {
        echo "Sorry, there was an error uncompressing your file $e ";
}

$filename = explode("_",$uncompressed);
$gpsData=$target_dir . $uncompressed . "/".$filename[1];

echo "gpsdata at $gpsData";

$f = fopen($gpsData, "r");
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gpsData";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



if ($f) {

    while (($line = fgets($f)) !== false) {
      if (trim($line)!= ''){
       $data = explode(",",$line);
       $sql = "INSERT INTO data (id_driver,id_trip,onroute,date,time,lat,lng,speedOverGround,courseOverGround,magneticVariation,cokpit_variance)
       VALUES ('$data[0]', '$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";

       if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
       } 
        else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }         

      }
    }

    fclose($f);
}


else {
    echo "Error reading file";
} 

$conn->close();


?> 

