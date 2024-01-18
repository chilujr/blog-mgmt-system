<?php

session_start();

// Include your database connection setup
require 'setup.php';

// Assuming you have a database connection established, replace the $connection variable with your actual connection variable
$host = "localhost";
$user = "root";
$pass = "";
$database = "blog_db";

$connection = mysqli_connect($host, $user, $pass) or die("Couldn't connect to the database");
mysqli_select_db($connection, $database);

// Fetch data from the login form
$username = mysqli_real_escape_string($connection, $_POST["username"]);
$psw = mysqli_real_escape_string($connection, $_POST["psw"]);

// Prepare and execute the SQL query
$query = "SELECT * FROM users
          WHERE Username = '$username'";

$ret = mysqli_query($connection, $query);

if (!$ret) {
    echo mysqli_error($connection);
    exit; // Exit if there's an error
}

$retresult = mysqli_num_rows($ret);

if ($retresult == 0) {
    echo "<script>alert('User not found, please try again')</script>";
    echo "<script>window.location='../login.html'</script>";
} else {
    $row = mysqli_fetch_assoc($ret);

    // Verify the password
    if (password_verify($psw, $row['Password'])) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.location='../index.html'</script>";
    } else {
        echo "<script>alert('Incorrect password, please try again')</script>";
        echo "<script>window.location='../login.html'</script>";
    }
}

// Close the database connection
mysqli_close($connection);

?>
