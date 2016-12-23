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


if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $code = $_POST['code'];


    $servername = "127.0.0.1";
    $DBusername = "root";
    $password = "";
    $dbname = "smarthouse";
    $conn = new mysqli($servername, $DBusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "select stock from product_stock where product_code = \"" . $code . "\";";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if ($result->num_rows > 0) {

            $stock = $row['stock'];
        }

    };


    echo <<<TAG
        <body>
            <div class="form">
TAG;

    if (isset($stock))
        if ($stock == 0) {
            echo "<h1>موجودی تمام شده است</h1>";
        } else {
            $stock -= 1;
            $sql = "update product_stock set stock = " . $stock . " where product_code =  \"" . $code . "\"";
            $conn->query($sql);


            $sql = "select * from USER where username = \"" . $username . "\";";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows > 0) {

                    $usernameexist = true;
                }

            };

            if (isset($usernameexist)) {
                $sql = "INSERT INTO `sell` (`order_number`, `order_time`, `product_code`, `username`) 
            VALUES (NULL, CURRENT_TIMESTAMP, '" . $code . "', '" . $username . "');";

                if ($conn->query($sql) === TRUE) {

                    echo "<h1>فروش انجام شد</h1>";
                } else {
//                if (strpos($conn->error, 'PRIMARY') !== true)
//                    echo "<h1>خطا: " . "<br>" . "نام کاربری وارد شده تکراری است" . "</h1>";
//                else
                    echo "<h1>Error: " . "<br>" . $conn->error . "</h1>";


                }
            }
            else{
                echo "<h1> کاربر وارد شده یافت نشد</h1>";
            }

        }
    else {
        echo "<h1>" . "محصول وارد شده یافت نشد" . "</h1>";
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
          <h1>خرید محصول</h1>
          
          <form action="./sellproduct.php" method="post">
         
         <div class="field-wrap">
            <input type="text" name="username" required placeholder="نام کاربری خریدار">
          </div>
          
          <div class="field-wrap">
            <input type="text" name="code" required placeholder="کد محصول">
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
