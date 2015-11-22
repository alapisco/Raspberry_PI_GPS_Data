# Getting and Processing GPS Data from Raspberry 

The code in this repository contains bash scripts that interacts with the GPS Hardware 
for the raspberry : https://www.adafruit.com/products/2324


## Raspberry side (client)

The raspberry/gpsData.sh  script sets a Linux service to  get GPS Data from the device

The raspberry/gpsData.sh reads the Raw GPS Data and process it to convert from NMEA convention to
latitude and longitude. It generates cvs data and appends it to a file.

The raspberry/sendData.sh compresses and sends this cvs data to a server. 



## Server side (PHP)

The server/post6.php  script , gets the data from the raspberry and stores it on a database.
