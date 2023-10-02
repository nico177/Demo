<?php 
    $servername = "localhost";
    $username = "sqluser";
    $password = "password";
    $dbName = "myquestions";
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
?>