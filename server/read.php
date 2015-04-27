<?php
$file_handle = fopen("/home/pi/example.txt","r");

while (!feof($file_handle)) {
   $line = fgets($file_handle);
   echo "$line <br>";
  
}

fclose($file_handle);
?> 
