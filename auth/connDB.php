<?php
    // connection script for MyBlog database
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'SeniorCapstone2022');
    define('DB_NAME', 'myblog_db');

    // connection string
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

    // attempt connection
    if($conn->connect_error){
        //connection failed
        die("Connection failed: " . $conn->connect_error);
    }

    //echo "Connection Successful!";
?>
