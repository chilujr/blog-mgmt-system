<?php

$host = "localhost";
$user = "root";
$pass = "";

//This creates the connection to the database
$connection = mysqli_connect($host, $user, $pass)
    or die ("Couldn't connect to the database");


// This links the page to the database
$database = "blog_db";
mysqli_select_db($connection, $database);


/* Create a table for user registration
$query = "CREATE TABLE IF NOT EXISTS users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    UNIQUE (Email)
)";

// Execute the query
$ret = mysqli_query($connection, $query);

if ($ret) {
    echo "<p>Table Created Successfully!</p>";
} else {
    echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
}

// Close the database connection if needed
mysqli_close($connection);
*/

