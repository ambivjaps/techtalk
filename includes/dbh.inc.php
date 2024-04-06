<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "techtalk_db";

/*
$dbServername = "sql309.epizy.com";
$dbUsername = "epiz_30525628";
$dbPassword = "MN70wFAfczfFlX";
$dbName = "epiz_30525628_techtalk_db";
*/

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}