<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            align:center;
        }
    </style>
</head>
<body>
<?php
$err=$pwd="";      
if ($_SERVER["REQUEST_METHOD"] == "POST") {
include_once 'conn.php';
$email =$_POST["email"];
$password=$_POST["password"];
if (empty($_POST["email"])) {
    $err = "Email is required";
}
else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Invalid email format";
    }
}
 $login ="SELECT * FROM `taskuser` WHERE `email`='$email' and `password`='$password'";
 $wrongemail ="SELECT * FROM `taskuser` WHERE `email`!='$email' and `password`='$password'";
 $wrongpassword ="SELECT * FROM `taskuser` WHERE `email`='$email' and `password`!='$password'";
$getrows=$conn->query($login);
$getrows1=$conn->query($wrongemail);
$getrows2=$conn->query($wrongpassword);
      
if ($getrows->num_rows>0) {
  $_SESSION['email']=$email;
  header("location:movie.php");
}
elseif($getrows1->num_rows>0 && $conn->query($sql1)){
   $err =  "wrong email <br>";   
}
elseif($getrows2->num_rows>0 && $conn->query($sql2)){
        $pwd =  "wrong password <br>";   
}
else {  
    echo '<script> 
    alert("account dosent exist kindly signin");
     window.location.href="signup.php";
    </script>'; 
}

}
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        EMAIL :<input type="email" name="email">
        <span><?php echo$err; ?></span><br><br>
        PASSWORD :<input type="password" name="password">
        <span><?php echo$pwd; ?></span><br><br>
        <input type="submit" name="login" value="Login"> <br><br>    
    </form>
    <div>New here?<a href="signup.php"><b>Create an account</b></a></div>
    
  
</body>
</html>