<?php
$servername = "127.0.0.1";
$DBusername = "root";
$password = "";
$dbname = "smarthouse";

$username =  $_GET['username'];

$conn = new mysqli($servername, $DBusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//create Table user

echo "light sensor:<br>";
$sql = "SElECT * from `light_sensor` WHERE `order_number` = 
(SELECT `order_number` FROM `sell` WHERE `username` = '".$username."');";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "time: " . $row["report_time"].
            " light intensity: " . $row["light_intensity"].
            " base light intensity: " . $row["base_light_intensity"]. "<br>" ;
    }
} else {
    echo "0 results"."<br>";
}

echo "temperature sensor:<br>";
$sql = "SElECT * from `temperature_sensor` WHERE `order_number` = 
(SELECT `order_number` FROM `sell` WHERE `username` = '".$username."');";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "time: " . $row["report_time"].
            " temperature: " . $row["light_intensity"]."<br>";
    }
} else {
    echo "0 results"."<br>";
}

echo "humidity sensor:<br>";
$sql = "SElECT * from `humidity_sensor` WHERE `order_number` = 
(SELECT `order_number` FROM `sell` WHERE `username` = '".$username."');";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "time: " . $row["report_time"].
            " humidity: " . $row["light_intensity"]."<br>";
    }
} else {
    echo "0 results"."<br>";
}



echo "gas sensor:<br>";
$sql = "SElECT * from `gas_sensor` WHERE `order_number` = 
(SELECT `order_number` FROM `sell` WHERE `username` = '".$username."');";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "time: " . $row["report_time"].
            "co2: " . $row["co2"].
            "co: " . $row["co"].
            "ch4: " . $row["ch4"]."<br>";
    }
} else {
    echo "0 results"."<br>";
}