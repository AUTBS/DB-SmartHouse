<?php

$order = $_GET['order'];
if (isset($_GET['data1']))
    $data1 = $_GET['data1'];
if (isset($_GET['data2']))
    $data2= $_GET['data2'];
if (isset($_GET['data3']))
    $data3 = $_GET['data3'];

$servername = "127.0.0.1";
$DBusername = "root";
$password = "";
$dbname = "smarthouse";

$conn = new mysqli($servername, $DBusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SElECT type_code from sell as s , product_stock as p where s.product_code = p.product_code and s.order_number = " . $order . ";";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    if ($result->num_rows > 0) {

        if ($row["type_code"] == 1) {

            $sql = "INSERT INTO light_sensor (order_number, report_time,light_intensity, base_light_intensity)
            VALUES ('" . $order . "', CURRENT_TIME, '" . $data2  . "', '" . $data2 . "')" ;
            echo $sql;

        } else if ($row["type_code"] == 2) {
            $sql = "INSERT INTO temperature_sensor (order_number, report_time,temperature)
            VALUES ('" . $order . "', CURRENT_TIME, '" . $data1  . "')" ;

        } else if ($row["type_code"] == 3) {
            $sql = "INSERT INTO humidity_sensor (order_number, report_time,humidity)
            VALUES ('" . $order . "', CURRENT_TIME, '" . $data1  . "')" ;

        } else if ($row["type_code"] == 4) {
            $sql = "INSERT INTO gas_Sensor (order_number, report_time,co2, co,ch4)
            VALUES ('" . $order . "', CURRENT_TIME, '" . $data2 . "', '" . $data2 . "', '" . $data3 . "')" ;

        }


        if ($conn->query($sql) === TRUE) {

        }
    }
}



