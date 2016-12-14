<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "smarthouse";

// Create connection
$conn = new mysqli($servername, $username, $password);
//create DB

$sql = "CREATE DATABASE " . $dbname;
$conn->query($sql);

echo "</br>";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "</br>";
}


//create Table user
$sql = "CREATE TABLE user (
username VARCHAR(20) PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
password VARCHAR(20)
);";

$conn->query($sql);

//create Table Product Type
$sql = "CREATE TABLE product_type (
type_code INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
type VARCHAR(30) NOT NULL
)";

$conn->query($sql);

//create Table product stock
$sql = "CREATE TABLE product_stock (
product_code INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
type_code INT(6) UNSIGNED NOT NULL,
price INT(20) NOT NULL,
stock INT(20) DEFAULT '0',
FOREIGN KEY (type_code) REFERENCES product_type(type_code)
)";

$conn->query($sql);

//create Table sell
$sql = "CREATE TABLE sell (
order_number INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
order_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
product_code INT(6) UNSIGNED, 
username VARCHAR(20),
FOREIGN KEY (product_code) REFERENCES product_stock(product_code),
FOREIGN KEY (username) REFERENCES user(username)
)";

$conn->query($sql);

//create Table light sensor
$sql = "CREATE TABLE light_sensor (
order_number INT(6) UNSIGNED , 
report_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  ,
light_intensity INT(6) UNSIGNED, 
base_light_intensity INT(6) UNSIGNED,
FOREIGN KEY (order_number) REFERENCES sell(order_number),
PRIMARY KEY (order_number,report_time)
)";

$conn->query($sql);

//create Table temperature sensor
$sql = "CREATE TABLE temperature_sensor (
order_number INT(6) UNSIGNED , 
report_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  ,
temperature INT(3) UNSIGNED, 
FOREIGN KEY (order_number) REFERENCES sell(order_number),
PRIMARY KEY (order_number,report_time)
)";

$conn->query($sql);

//create Table humidity sensor
$sql = "CREATE TABLE humidity_sensor (
order_number INT(6) UNSIGNED , 
report_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  ,
humidity INT(3) UNSIGNED, 
FOREIGN KEY (order_number) REFERENCES sell(order_number),
PRIMARY KEY (order_number,report_time)
)";

$conn->query($sql);

//create Table gas sensor
$sql = "CREATE TABLE gas_sensor (
order_number INT(6) UNSIGNED , 
report_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  ,
co2 INT(3) UNSIGNED, 
co INT(3) UNSIGNED, 
ch4 INT(3) UNSIGNED, 
FOREIGN KEY (order_number) REFERENCES sell(order_number),
PRIMARY KEY (order_number,report_time)
)";

$conn->query($sql);

echo "
 <html>
<body>

<button  type=\"button\"id=\"demo\" onclick=\"myFunction()\">user profile.</button>
<form action = \"sensor.php\" method = \"GET\">
         Username: <input type = \"text\" name = \"username\" />
         <input type = \"submit\" />
      </form>

<script>
function myFunction() {
    window.location=\"./user.php\";
}
</script>

</body>
</html>

";

$conn->close();
?>

