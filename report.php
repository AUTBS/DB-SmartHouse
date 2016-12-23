<?php

echo <<<'TAG'
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

   <script type="text/javascript" src="js/scripts.js"></script>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  
  <div class="hot-container">
  <img src="https://camo.githubusercontent.com/afc284462330fff4cf7c03c5bd4a5120431eb84f/687474703a2f2f616f6c61622e6769746875622e696f2f49313832302f6c6f676f2f6c6f676f2d6d642e706e67" alt="i1820" style="width:504px;height:428px;">

	
</div>



TAG;

$servername = "127.0.0.1";
$DBusername = "root";
$password = "";
$order = $_GET['order'];
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
            echo <<<TAG
            <h1>گزارش های ثبت شده توسط سنسور نور  </h1>

<table class="responstable">
  <tr>
    <th data-th="Driver details"><span>زمان گزارش</span></th>
        <th>میزان نور</th>
    <th>میزان نور پایه</th>

  </tr>
TAG;

            $query = "SElECT * from light_sensor where order_number = " . $order . ";";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows > 0) {
                    echo "<tr>";
                    echo "<td>" . $row["report_time"] . "</td>";
                    echo "<td>" . $row["light_intensity"] . "</td>";
                    echo "<td>" . $row["base_light_intensity"] . "</td>";
                    echo "</tr>";
                }
            }

        }
        if ($row["type_code"] == 2) {
            echo <<<TAG
            <h1>گزارش های ثبت شده توسط سنسور دما  </h1>

<table class="responstable">
  <tr>
    <th data-th="Driver details"><span>زمان گزارش</span></th>
        <th>میزان دما</th>

  </tr>
TAG;

            $query = "SElECT * from temperature_sensor where order_number = " . $order . ";";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows > 0) {
                    echo "<tr>";
                    echo "<td>" . $row["report_time"] . "</td>";
                    echo "<td>" . $row["temperature"] . "</td>";
                    echo "</tr>";
                }
            }

        }
        if ($row["type_code"] == 3) {
        echo <<<TAG
            <h1>گزارش های ثبت شده توسط سنسور رطوبت  </h1>

<table class="responstable">
  <tr>
    <th data-th="Driver details"><span>زمان گزارش</span></th>
        <th>میزان رطوبت</th>

  </tr>
TAG;

        $query = "SElECT * from humidity_sensor where order_number = " . $order . ";";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            if ($result->num_rows > 0) {
                echo "<tr>";
                echo "<td>" . $row["report_time"] . "</td>";
                echo "<td>" . $row["humidity"] . "</td>";
                echo "</tr>";
            }
        }

    }
        if ($row["type_code"] == 4) {
        echo <<<TAG
            <h1>گزارش های ثبت شده توسط سنسور گاز  </h1>

<table class="responstable">
  <tr>
    <th data-th="Driver details"><span>زمان گزارش</span></th>
        <th>میزان گاز CO</th>
        <th>میزان گاز CO2</th>
        <th>میزان گاز CH4</th>

  </tr>
TAG;

        $query = "SElECT * from gas_sensor where order_number = " . $order . ";";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            if ($result->num_rows > 0) {
                echo "<tr>";
                echo "<td>" . $row["report_time"] . "</td>";
                echo "<td>" . $row["co"] . "</td>";
                echo "<td>" . $row["co2"] . "</td>";
                echo "<td>" . $row["ch4"] . "</td>";
                echo "</tr>";
            }
        }

    }
    }
}


echo <<<TAG
</table>

</body>
</html>
TAG;
