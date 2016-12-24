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
TAG;

if (!isset($_POST['query']))
    echo <<<TAG
	 <div id="signup">   
          <h1>وارد کردن دستور</h1>
          
          <form action="./query.php" method="post">
         
         <div class="field-wrap">
            <input type="text" name="query" required placeholder="دستور">
          </div>
  
          
          <button type="submit" class="button button-block"/>اجرا کن</button>
          
          </form>

        </div>
</div>
</body>
</html>
TAG;
else {

    $servername = "127.0.0.1";
    $DBusername = "root";
    $password = "";
    $dbname = "smarthouse";
    $conn = new mysqli($servername, $DBusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $query = $_POST['query'];

    echo "<table class=\"responstable\">";

    if(strpos($query, 'select') !== false) {
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<th>" . $key . "</th>";
        }
        echo "</tr>";


        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {


            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
    } else{

        if ($conn->query($query) === TRUE) {

            echo "<h1>مورد درخواستی اجرا شد</h1>";
        } else {
                echo "<h1>Error: " . "<br>" . $conn->error . "</h1>";
        }
    }

    echo "</table>";


}