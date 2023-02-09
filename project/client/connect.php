
<?php
session_start();
$server="localhost";
$username="root";
$password="";
$database="royal_event";
$connect=mysqli_connect($server,$username,$password) or die(mysqli_error($connect));
/*if ($connect== true){
  echo " connected successfully";  
};
*/
$db=mysqli_select_db($connect,$database) or die(mysqli_error($connect));
/* if ($db == true){
    echo " connection to ". $database . " database successfull";
};
*/
?>
