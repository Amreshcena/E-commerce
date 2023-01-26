<?php

$uname = $_POST['uname'];
$upwsd1 = $_POST['upwsd1'];
$upwsd2 = $_POST['upwsd2'];
$email  = $_POST['email'];




if (!empty($uname) || !empty($upwsd1) || !empty($upwsd2) || !empty($email) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "scart";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From signup Where email = ? Limit 1";
  $INSERT = "INSERT Into signup (uname ,upwsd1, upwsd2, email )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $uname,$upwsd1,$upwsd2,$email);
     
      echo "Welcome to ShopMe.com! Signup was Completed !
            Click back to Login! ";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>