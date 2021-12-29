<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST["signup"])) {
                    include("conn.php");
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $city = $_POST["city"];

                     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        die( '<script> 
                        alert("invalid email ");
                        window.location.href="signup.php";
                        </script>');
                    } 

                      $selectuserdata = "SELECT * FROM `taskuser` WHERE `email` = '$email'";
                      $insertuser ="INSERT INTO `taskuser`(`name`, `email`, `password`, `city`) VALUES ('$name','$email','$password','$city')";
                      $getrows=$conn->query($selectuserdata);
                      
                      if ($getrows->num_rows>0 ) {
                         
                        echo '<script> 
                        alert("you already have an account try to log in");
                        window.location.href="signin.php";
                        </script>';  
                      }
                      elseif($conn->query($insertuser)) {
                           echo '<script> 
                            alert("account created succesfully");
                             window.location.href="signin.php";
                            </script>'; 
                        }
                        else {
                             echo ".";
                        }
                }

    }



    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        NAME :<input type="text" name="name" required><br><br>
        EMAIL :<input type="email" name="email" required>
        <span><?php echo $err; ?></span><br><br>
        PASSWORD :<input type="password" name="password" minlength="6" required><br><br>
        CITY :<input type="text" name="city"required><br><br>
       
         <input type="submit" name="signup" value="Signup"> <br><br>  
         <div>already a user? <a href="signin.php"><b>Login</b></a></div>

    </form>
  
</body>
</html>