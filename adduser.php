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
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $servername = "127.0.0.1";
    $DBusername = "root";
    $password = "";
    $dbname = "smarthouse";
    $conn = new mysqli($servername, $DBusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO user(firstname, lastname, password,username)
            VALUES ('" . $fname . "', '" . $lname . "', '" . $password . "','" . $uname . "')";


    echo <<<TAG
        <body>
            <div class="form">
TAG;

    if ($conn->query($sql) === TRUE) {

        echo "<h1>کاربر اضافه شد</h1>";
    } else {
        if (strpos($conn->error, 'PRIMARY') !== true)
            echo "<h1>خطا: " . "<br>" . "نام کاربری وارد شده تکراری است" . "</h1>";
        else
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
          <h1>اضافه کردن کابر</h1>
          
          <form action="./adduser.php" method="post">
         
         <div class="field-wrap">
            <input type="text" name="username" required placeholder="نام کاربری">
          </div>
          
          <div class="field-wrap">
            <input type="text" name="lname" required placeholder="نام">
          </div>
          
        <div class="field-wrap">
            <input type="text" name="fname" required placeholder="نام خانوادگی">
          </div>
          
          
          <div class="field-wrap"> 
            <input type="password"  name="password" required autocomplete="off"  placeholder="کلمه عبور"/>
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
