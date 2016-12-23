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
<h1>لیست کاربران </h1>

<table class="responstable">
  
  <tr>
    <th> نام کاربری </th>
    <th data-th="Driver details"><span>نام</span></th>
    <th>نام خانوادگی</th>
   
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

$query = 'select *
			From user';
$result = $conn->query($query);

while($row = $result->fetch_assoc()) {
    if ($result->num_rows > 0) {

        echo "<tr>";
        echo "<td><a href=\"./viewuser.php?username=".$row["username"]."\">".$row["username"]."</a></td>";
        echo "<td>".$row["firstname"]."</td>";
        echo "<td>".$row["lastname"]."</td>";


        echo "</tr>";
    }
}



echo <<<TAG
</table>
</body>
</html>
TAG;
