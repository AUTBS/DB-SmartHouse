<?php


echo <<<TAG

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

TAG;


if (isset($_POST['code'])) {
    $code = $_POST['code'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $servername = "127.0.0.1";
    $DBusername = "root";
    $password = "";
    $dbname = "smarthouse";
    $conn = new mysqli($servername, $DBusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO product_stock(product_code, type_code, price  ,stock)
            VALUES ('" . $code . "', '" . $type . "', '" . $price . "','" . $stock . "')";


    echo <<<TAG
        <body>
            <div class="form">
TAG;

    if ($conn->query($sql) === TRUE) {

        echo "<h1>محصول اضافه شد</h1>";
    } else {
//        if (strpos($conn->error, 'PRIMARY') !== true)
//            echo "<h1>خطا: " . "<br>" . "کد محصول وارد شده تکراری است" . "</h1>";
//        else
            echo "<h1>Error: " . "<br>" . $conn->error . "</h1>";


    }
    echo "<a href=\"#\" onclick=\"back()\" class=\"btn btn-red\">بازگشت</a>";
    echo <<<TAG
</div> <!-- /form --> 
</body>
TAG;

} else {
    echo <<<TAG

<body>
 <div class="form">
      
  
      
     
        <div id="signup">   
          <h1>اضافه کردن محصول</h1>
          
          <form action="./addproduct.php" method="post">
         
         <div class="field-wrap">
            <input type="text" name="code" required placeholder="کد محصول">
          </div>
          
           <div class="field-wrap">
           <select name="type">

TAG;
    $servername = "127.0.0.1";
    $DBusername = "root";
    $password = "";
    $dbname = "smarthouse";
    $conn = new mysqli($servername, $DBusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "select * from product_type;";
    $result = $conn->query($query);

    while($row = $result->fetch_assoc()) {
        if ($result->num_rows > 0) {


            echo " <option value=\"".$row['type_code']."\">".$row['type']."</option>";

        }
    }


    echo <<<TAG
            </select>
            </div>
         <div class="field-wrap">
            <input type="text" name="price" required placeholder="قیمت">
          </div>
          
        <div class="field-wrap">
            <input type="text" name="stock" required placeholder="موجودی">
          </div>
          
    
          
          <button type="submit" class="button button-block"/>اضافه کن!</button>
          
          </form>

        </div>

      
</div> <!-- /form --> 

</body>


TAG;

}
echo <<<TAG
</html>
TAG;
