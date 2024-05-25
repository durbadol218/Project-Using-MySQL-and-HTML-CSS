<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include("php/config.php");
    
            if (isset($_POST['submit'])) {
              $email = mysqli_real_escape_string($con, $_POST['email']);
              $password = $_POST['password'];
    
              $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error");
              $row = mysqli_fetch_assoc($result);
    
              if ($row && password_verify($password, $row['passwordd'])) { // Use 'Password' instead of 'passwordd'
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['id'] = $row['id'];
    
                header("Location: home.php"); // Redirect to home page on successful login
              } else {
                echo "<div class='message'>
                        <p>Wrong Email or Password!</p>
                      </div> <br>";
                echo "<a href='index.php'><button class='btn'>Go Back</button>";
              }
            } else {
            ?>
            <header>Login Page</header>
            <form action="" method="post">
                <div class="field input">
                    <label class="required" for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" placeholder="Abdur@gmail.com" required>
                </div>

                <div class="field input">
                    <label class="required" for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="abc1234" required>
                    <div class="links-forgot">
                    <span><a class="forgot" href="#">Forgot Password?</a></span>
                    </div>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account?
                    <span><a href="register.php">Sign Up!!!</a></span>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>