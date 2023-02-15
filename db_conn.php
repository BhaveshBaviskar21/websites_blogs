<?php
    $dbhost = "172.17.0.3";
    $dbname = "trib_db";
    $dbuser= "root";
    $dbpass = "root";
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    if(!$conn){
        die("could not connect:".mysqli_connect_error());
    }
?>