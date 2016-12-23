<?php

$order = $_GET['order'];
while (1) {


    echo
    $url = "http://localhost/smarthouse/sence.php?order=".$order."&data1=" . mt_rand(1, 10) . "&data3=" . mt_rand(10, 20) .
        "&data2=" . mt_rand(20, 30);
//Initialize cURL.
    $ch = curl_init();

//Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $url);


    $data = curl_exec($ch);

//Close the cURL handle.
    curl_close($ch);
    $sleep = 1;
    sleep($sleep);

}
//Print the data out onto the page.
//}

