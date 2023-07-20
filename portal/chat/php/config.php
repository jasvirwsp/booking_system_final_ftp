<?php
  $hostname = "localhost";
  $username = "turntabl_tableuser";
  $password = "8Ivef8u&eWw5";
  $dbname = "turntabl_psntable";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
