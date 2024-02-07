<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $name= htmlspecialchars($_POST["name"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    



    
    $query = "INSERT INTO user1 (name,username, password) VALUES ('$name','$username', '$password')";

    if ($con->query($query) === TRUE) {
        header("Location:index.html");
        exit; // You should exit after a successful header redirection to prevent further execution
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }

    $con->close();
}
?>
