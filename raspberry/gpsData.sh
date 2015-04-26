#!/bin/bash


while read line; do


   
 #Identify type of NMEA sentence
 ID=$(echo $line | awk -F"," '{print $1}' )


 #If a $GPRMC sentence is found
 if [[ $ID == *GPRMC* ]]; then

  #Check number of elements found in the sentence by checking the number of commas found
  COMMAS=$(grep -o "," <<<"$line" | wc -l )

  #If the sentence has 12 commas then it is a valid $GPRMC sentence
  if [ "$COMMAS" -eq 12 ];then
  
  #parse data

  UTC_TIME=$(echo $line | awk -F"," '{print $2}' )
  STATUS=$(echo $line | awk -F"," '{print $3}' )
  LATITUDE=$(echo $line | awk -F"," '{print $4}' )
  NSIndicator=$(echo $line | awk -F"," '{print $5}' )
  LONGITUDE=$(echo $line | awk -F"," '{print $6}' )
  EWIndicator=$(echo $line | awk -F"," '{print $7}' )
  SpeedOverGround=$(echo $line | awk -F"," '{print $8}' )
  CourseOverGround=$(echo $line | awk -F"," '{print $9}' )
  DATE=$(echo $line | awk -F"," '{print $10}' )
  MAGNETIC_VARIATION=$(echo $line | awk -F"," '{print $11}' )
  MODE=$(echo $line | awk -F"," '{print $12}' )
  CHECKSUM=$(echo $line | awk -F"," '{print $13}' )

  echo "$DATE,$UTC_TIME,$LATITUDE,$NSIndicator,$LONGITUDE,$EWIndicator,$SpeedOverGround" >> /home/pi/gpsDataLog

  fi

 fi

done < /dev/ttyAMA0
