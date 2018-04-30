<?php
$host = "localhost";
$user = "root";
$password = "usbw";
$database = "ppm";

try
{
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch
(PDOException $e){
    echo "The database is not connected " . $e;
}