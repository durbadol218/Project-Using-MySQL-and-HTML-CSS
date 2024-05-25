<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Registration Page</title>
    <style>
        .required::after {
            content: " *";
            color: red;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include("php/config.php");
            if (isset($_POST['submit'])) {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $passwordd = $_POST['password'];
                $passwordRepeat = $_POST['repeat_password'];

                //verifying the unique email
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
            <p>This email is used, Try another One Please!</p>
            </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    if ($passwordd != $passwordRepeat) {
                        echo "<div class='message'>
                <p>Password does not matched, please try again!</p>
                </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        $password_hash = password_hash($passwordd, PASSWORD_DEFAULT);
                        $insert_query = mysqli_query($con, "INSERT INTO users(First_Name, Last_Name, Username, Email, passwordd) VALUES('$firstname','$lastname','$username','$email','$password_hash')") or die("Error Occured!");
                        if ($insert_query) {
                            echo "<div class='message'>
                        <p>Registration successful!</p>
                    </div> <br>";
                            echo "<a href='index.php'><button class='btn'>Login Now</button>";
                        } else {
                            // Handle database insertion error (optional)
                            echo "<div class='message error'>
                        <p>Registration failed! Please try again.</p>
                      </div> <br>";
                            // mysqli_query($con,"INSERT INTO users(First_Name,Last_Name,Username,Email,passwordd) VALUES('$firstname','$lastname','$username','$email','$passwordd')") or die("Error Occured!");
                            // echo "<div class='message'>
                            // <p>Registration successfully!</p>
                            // </div> <br>";
                            // echo "<a href='index.php'><button class='btn'>Login Now</button>";
                        }
                    }
                }
            } else {
            ?>
                <header>Sign Up</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="firstname" class="required">First Name</label>
                        <input type="text" name="firstname" id="firstname" autocomplete="off" placeholder="Abdur" required>
                    </div>
                    <div class="field input">
                        <label for="lastname" class="required">Last Name</label>
                        <input type="text" name="lastname" id="lastname" autocomplete="off" placeholder="Rahman" required>
                    </div>

                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" placeholder="abc1234" required>
                    </div>

                    <div class="field input">
                        <label for="email" class="required">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off" placeholder="abc@gmail.com" required>
                    </div>

                    <div class="field input">
                        <label for="password" class="required">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="repeatPassword" class="required">Confirm Password</label>
                        <input type="password" name="repeat_password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Sign Up" required>
                    </div>
                    <div class="links">
                        Already have an account? <a href="index.php">Please Sign In Here!</a>
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>
</body>

</html>