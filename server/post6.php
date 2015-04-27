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


$gpsData=$target_dir . $uncompressed . "/gpsData";

echo "gpsdata at $gpsData"




?> 
