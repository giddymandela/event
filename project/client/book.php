<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
session_start();
//error_reporting(0);
$link = mysqli_connect("localhost", "root", "", "royal_event");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (isset($_POST['addbooking'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $eventdate = $_POST['eventdate'];
    $starttime = $_POST['est'];
    $endtime = $_POST['eetime'];
    $vaddress=$_POST['address'];
    $eventtype=$_POST['eventtype'];
    $addinfo=$_POST['info'];
    $bookingid=mt_rand(100000000, 999999999);


    // Attempt insert query execution
    $sql = "INSERT INTO tblbooking(BookingID, ServiceID,Name,MobileNumber, Email, EventDate, EventStartingtime,EventEndingtime,VenueAddress, EventType,AdditionalInformation) VALUES (' $bookingid','null','$name','$contact', '$email', '$eventdate', '$starttime', '$endtime','$vaddress','$eventtype','$addinfo')";
    if(mysqli_query($link, $sql)){
        echo "<script>alert('Booking information Successful'); window.location.href='home.php';</script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
    // Close connection
    mysqli_close($link);
}

?>