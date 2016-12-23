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

<h1>لیست محصولات </h1>

<table class="responstable">
  
  <tr>
    <th> کد محصول </th>
    <th data-th="Driver details"><span>نوع محصول</span></th>
    <th>قیمت</th>
    <th>موجودی</th>
   
  </tr>
TAG;

$servername = "127.0.0.1";
$DBusername = "root";
$password = "";
$dbname = "smarthouse";
$conn = new mysqli($servername, $DBusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SElECT * from product_stock as p ,  product_type as t WHERE p.type_code =  t.type_code;";
$result = $conn->query($query);

while($row = $result->fetch_assoc()) {
    if ($result->num_rows > 0) {

        echo "<tr>";
        echo "<td><a href=\"./updateproduct.php?code=".$row["product_code"]."\">".$row["product_code"]."</a></td>";
        echo "<td>".$row["type"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["stock"]."</td>";


        echo "</tr>";
    }
}



echo <<<TAG
</table>

</body>
</html>
TAG;
