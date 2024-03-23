<?php
    // local
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    $UDB = "USE mydb";
    $dbname='mydb';
    $conn->query($UDB);

    // KLH SITE
    // $servername = "db";
    // $username = "iior";
    // $password = "KlIiorSite#723";
    // $conn = new mysqli('db', 'iior', 'KlIiorSite#723', 'mydb');
    // $UDB = "USE mydb";
    // $dbname='mydb';
    // $conn->query($UDB);
    
    
    ?> 
