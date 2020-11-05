<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <style>
    
        
        
    </style>
</head>
<body>
<div class="header"><h1><center>UserRegistration</center></h1></div>
    <div class="UserForm">
        <form action="UserRegistration.php" method="post" class="reg-form">
            <b>User Name</b>
            <br><input type="text" name="username" placeholder="username" required><br><br>
            <b>Phone</b>
            <br><input type="text" name="number" placeholder="number" required><br><br>
            <b>Password</b>
            <br><input type="password" name="password" placeholder="password" required><br><br>
            <b>Confirm Password</b>
            <br><input type="password" name="ConfirmPass" placeholder="confirm password" required><br><br>
            <button type="submit" name="register" value="submit"><b>Register</b></button>
        </form>
    
        <?php
            if(isset($_POST['register']))
            {
                $name=$_POST["username"];
                $number=$_POST["number"];
                $password=$_POST["password"];
                $Cpassword=$_POST["ConfirmPass"];

                if(!strcmp($password,$Cpassword))
                {
                
                $qry="select * from customerDetails where number={$number}";
                $result=mysqli_query($connection,$qry);
      
                        if(mysqli_num_rows($result)>0)
                        {
                            echo "<script>alert(\"Number already exist. please login\")</script>";
                            echo "<script>window.location=\"userLogin.php\"</script>";
                        
                            mysqli_close($connection);
                        }else{
                            $sql = "INSERT INTO customerDetails (name,number,password) VALUES ('{$name}',{$number},'{$password}')";
                            $result=mysqli_query($connection,$sql);
                            if($result){
                                echo "<script>alert(\"Registration Successful\")</script>";
                                echo "<script>window.location=\"userLogin.php\"</script>";
                            }else{
                                echo "<script>alert(\"Registration Failed\")</script>";
                            }
                        
                            
                          
                            mysqli_close($connection);
                        }
                }
                else
                {
                    echo "<br><br><h3 style=\"color:red;\"><center>Password mismatch*</center></h3>";
                }
            }

        ?>
    </div>
</body>
</html>