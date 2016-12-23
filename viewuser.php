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
$dbname = "smarthouse";
$username = $_GET['username'];
$conn = new mysqli($servername, $DBusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = 'select *
			From user
			Where username = \'' . $username . '\'   ;';
$result = $conn->query($query);

// output data of each row

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h1>نام کاربری: " . $row["username"] . "  نام و نام خانوادگی: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
} else {
    echo "0 results";
}


$query = "SELECT sum(price) as sum  from product_stock as p ,  sell as s  WHERE p.product_code =  s.product_code and 
          s.username= \"" . $username . "\";";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["sum"];
    }
} else {
    echo "0 results";
}

echo ":مجموع فاکتورها " . $row["sum_price"] . "<br>";

echo <<<TAG
<table class="responstable">
  
  <tr>
    <th>شماره سفارش</th>
    <th data-th="Driver details"><span>زمان سفارش</span></th>
    <th>کد محصول</th>
   
  </tr>
 
TAG;

//Sum
$query = "SELECT *   from product_stock as p ,  sell as s  WHERE p.product_code =  s.product_code and 
          s.username= \"" . $username . "\";";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td><a href=\"./report.php?order=".$row["order_number"]."\">".$row["order_number"]."</a></td>";
        echo "<td>".$row["order_time"]."</td>";
        echo "<td>".$row["product_code"]."</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

echo <<<TAG
</table>
</body>
</html>
TAG;

?>