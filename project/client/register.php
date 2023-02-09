<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "royal_event");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (isset($_POST['adduser'])) {
    $name = $_POST['username'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobilenumber = $_POST['mobilenumber'];
    $password = $_POST['password'];


    // Attempt insert query execution
    $sql = "INSERT INTO users(Username, Fname, Lname, Email, MobileNumber, Password) VALUES ('$name', '$fname', '$lname', '$email', '$mobilenumber', '$password')";
    if(mysqli_query($link, $sql)){
        echo "<script>alert('Account Created Successfully'); window.location.href='login1.php';</script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
    // Close connection
    mysqli_close($link);
}

?>