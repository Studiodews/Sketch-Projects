<?php

//connection variables
$host = 'localhost';
$user = 'root';
$password = 'root';

//create mysql connection
$mysqli = new mysqli($host, $user, $password);
if ($mysqli->connect_errno) {
  printf("Connection failed: %s\n", $mysqli->connect_error);
  die();
}

//create the database
if (!$mysqli->query('CREATE DATABASE IF NOT EXISTS appstore')) {
  printf("Errormessage: %s\n", $mysqli->error);
}

//create users table with all the fields
$mysqli->query('
CREATE TABLE IF NOT EXISTS `appstore`.`apps` (
  `appID` int(11) NOT NULL,
  `appName` varchar(80) NOT NULL,
  `appShortDesc` varchar(100) NOT NULL,
  `applongDesc` varchar(255) NOT NULL,
  `appIcon` longblob NOT NULL,
  `developerID` int(11) NOT NULL,
  `appVersion` float NOT NULL,
  `appReleaseDate` datetime NOT NULL,
  `appLanguage` varchar(25) NOT NULL,
  `appMainCatID` int(11) NOT NULL,
  `appSubCatID` int(11) DEFAULT NULL,
  `appPlatformID` int(11) NOT NULL,
  `appSysRequirements` varchar(255) NOT NULL,
  `appSize` float NOT NULL,
  `appPrimaryLink` varchar(255) NOT NULL,
  `appSecondaryLink` varchar(255) DEFAULT NULL,
  `appVideoLink` varchar(255) DEFAULT NULL,
  `appScreenshot1` varchar(255) NOT NULL,
  `appScreenshot2` varchar(255) DEFAULT NULL,
  `appScreenshot3` varchar(255) DEFAULT NULL,
  `appScreenshot4` varchar(255) DEFAULT NULL,
  `appScreenshot5` varchar(255) DEFAULT NULL,
  `appDownloads` int(11) DEFAULT NULL,
  `approvalDate` datetime DEFAULT NULL,
  `appState` int(11) DEFAULT 
  )
  ') or die($mysqli->error);


?>