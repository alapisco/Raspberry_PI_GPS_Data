# Getting and Processing GPS Data from the Raspberry PI

The code in this repository contains bash scripts that interacts with the GPS Hardware 
for the raspberry:

https://www.adafruit.com/products/2324

They are located in the raspberry folder

The samples directory contains raw GPS data that the Rapberry PI receives and it is
later converted to latitude and longitude

It also contains a php script that receves this data for db storage and some other tools. 
They are located in the server folder




## Raspberry side (client)

The raspberry/gpsData file is a script that sets a Linux service so the GPS Data is read from the device
as soon as the OS boots. This data is directed to a log file for further processing.

The raspberry/gpsData.sh script reads the Raw GPS Data and process it to convert from NMEA convention to
latitude and longitude. It generates a cvs file.

The raspberry/sendData.sh script compresses and sends this cvs data to a server. 



## Server side (PHP)

The server/post6.php  script gets the data from the raspberry and stores it on a database.
