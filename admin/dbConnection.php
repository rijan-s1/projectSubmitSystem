<?php

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "task";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " );
}

?>