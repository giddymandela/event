<?php
require "connect.php";
?>
<!--==SIGNUP NEW USER==-->
<?php
if(isset($_POST["signup"])){
  $usermail=$_POST["usermail"];
    $password=$_POST["userpass1"];
        $type="customer";
    $password2=$_POST["userpass2"];
    
if($password == $password2){
    $pass=md5($password); //encrypt password
$sql=" INSERT INTO `users` (`email`, `phone`, `address`, `password`,'type','date') VALUES ('$email', '$address', '$password', ,'$type',current_timestamp())";
$query=mysqli_query($connect,$sql) or die (mysqli_error($connect));
    
   if ($query == true){
        echo "<script type='text/javascript'>alert('Account Created Successufully'); window.location='login.php'</script>";
    
    };
  
}
    else {
        
        echo 
            "<script type='text/javascript'>alert('Error: Passwords Dont match'); window.location='signup.php'</script>"; 
    };
    
};

?>

<!--==LOGIN USER==-->

<?php
if(isset($_POST["login"])){
$usermail=$_POST["email"];
$password=$_POST["password"];
    
$sql="SELECT * FROM `users` where email = '$usermail'";
$query=mysqli_query($connect,$sql) or die (mysqli_error($connect));
$result=mysqli_fetch_assoc($query);
$email2=$result["email"];
$pass=$result["password"];
$type=$result["type"];
    if($usermail == $email2 and $password == $pass){
        if($type == 'admin'){
            $_SESSION["idm"]=$email2;
          header("location:admin/index_admin.php"); 
            
        }
        elseif($type == 'customer'){
            $_SESSION["idm"]=$email2;
            header("location:customer/index.php");
            
        }
    };
    
    if($pass != $password){
            echo "<script type='text/javascript'>alert('Error: Wrong Password'); window.location='login.php'</script>";
    };
    
};

?>
