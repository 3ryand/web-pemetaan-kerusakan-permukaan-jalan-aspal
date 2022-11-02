<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="automat1_web_pemetaan";
    
    $con = mysqli_connect($host,$user,$password,$db);
    if (!$con){
          die("Koneksi gagal:".mysqli_connect_error());
    }
    mysqli_select_db($con,"automat1_web_pemetaan");
?>