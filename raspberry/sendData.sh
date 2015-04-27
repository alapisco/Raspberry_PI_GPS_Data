#!/bin/bash


#tmp directory
tmpDir=/home/james/tmp

# Car identifier
CAR_ID=JHY1636

# Directory where the gps data file is
dataDir=/home/james

# Gps data file
dataFile=gpsData

# server upload url
uploadUrl="http://alapisco.zapto.org/post6.php"


#Create a tmp directory 
dirName="$CAR_ID"_"$(date +'%d%m%y%H%M%S')"
mkdir -p $tmpDir/$dirName


#Copy gpsData to a tmp dir
cp $dataDir/$dataFile $tmpDir/$dirName
cd $tmpDir


#Compressing data file
tarFile=$dirName".tar.gz"
tar -czf $tarFile $dirName

#Send data file to server
curl -F"operation=upload" -F"fileToUpload=@$tarFile" $uploadUrl

#clear tmp contents
rm -rf $tmpDir/*
