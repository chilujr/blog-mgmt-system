<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Include your database connection setup
    require 'setup.php';

    // Assuming you have a database connection established, replace the $connection variable with your actual connection variable
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "blog_db";

    $connection = mysqli_connect($host, $user, $pass) or die("Couldn't connect to the database");
    mysqli_select_db($connection, $database);

    // Fetch data from the registration form
    $uname = mysqli_real_escape_string($connection, $_POST["uname"]);
    $fname = mysqli_real_escape_string($connection, $_POST["fname"]);
    $lname = mysqli_real_escape_string($connection, $_POST["lname"]);
    $mail = mysqli_real_escape_string($connection, $_POST["mail"]);
    $psw = mysqli_real_escape_string($connection, $_POST["psw"]);
    $repeat = mysqli_real_escape_string($connection, $_POST["repeat"]);

    // Hash the password for security
    $hashedPassword = password_hash($psw, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $query = "INSERT INTO users (Username, FirstName, LastName, Email, Password, PasswordRepeat, Role) VALUES ('$uname', '$fname', '$lname', '$mail', '$hashedPassword', '$repeat', 'Standard')";

    $ret = mysqli_query($connection, $query);

    if ($ret) {
        session_start();
        $_SESSION['logged_in'] = true;
        echo "<script>alert('You have been registered successfully')</script>";
        echo "<script>window.location='../index.html'</script>";
    } else {
        echo mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}

?>
