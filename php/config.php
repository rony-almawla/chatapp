<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chatapp";

  // Establishing a connection to the database
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  // Check if connection was successful
  if (!$conn) {
    // If connection fails, output an error message
    echo "Database connection error: " . mysqli_connect_error();
  }
?>