<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>

    <script>
        /*
        function confirmPassword(password,password_confirmation)
        {
            if (password.localeCompare(password_confirmation))
            {
                alert("Password doesn't match");
                return false;
            }
            return true;
        }
            function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(String(email).toLowerCase())) {
                alert("Incorrect email format");
                return false;
            }
            return true;
        }
         function validateRegister()
        {
            var password = document.getElementById("password").value;
            var password_confirmation = document.getElementById("password_confirmation").value;
            var email = document.getElementById("email").value;
            if (!validateEmail(email) || !confirmPassword(password,password_confirmation))
            {
                return false;
            }
            else
            return true;

        }
        */
        function validateRegister()
        {
                var emailCheck=document.forms["register"]["email"].value;
                var fnameCheck=document.forms["register"]["first_name"].value;
                var lnameCheck=document.forms["register"]["last_name"].value;
                var passCheck=document.forms["register"]["password"].value;
                var confirmPassCheck=document.forms["register"]["password_confirmation"].value;
                if(emailCheck == "")
                {
                    alert("Email field can't be empty!");
                    return false;
                }
                if(fnameCheck == "")
                {
                    alert("First Name field can't be empty!");
                    return false;
                }
                if(lnameCheck == "")
                {
                    alert("Last Name field can't be empty!");
                    return false;
                }
                if(passCheck == "")
                {
                    alert("Password field can't be empty!");
                    return false;
                }
                if(confirmPassCheck == "")
                {
                    alert("Confirm Password field can't be empty!");
                    return false;
                }
                //check password and confirm password are the same
                if(passCheck != confirmPassCheck)
                {
                    alert("Password and Confirm Password must be identical!");
                    return false;
                }
                //validate the email
                var mail_format = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if(!emailCheck.match(mail_format))
                {
                    alert("Please enter a valid E-mail format!");
                    return false;
                }
        }
        </script>
</head>
<?php
require 'db.php';
// When form submitted, insert values into the database.
if (isset($_REQUEST['email'])) {
    // removes backslashes
    $first_name = stripslashes($_REQUEST['first_name']);
    $first_name = mysqli_real_escape_string($con, $first_name);
    $last_name = stripslashes($_REQUEST['last_name']);
    $last_name = mysqli_real_escape_string($con, $last_name);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    if (mysqli_num_rows(mysqli_query($con,"SELECT * FROM `user` WHERE email = '$email'")))
           {
            echo "<div class='form'>
                  <h3>Email already registerd!</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>register</a> again.</p>
                  </div>";
    }
    else
    {   $query = "INSERT into `user` (first_name, last_name, password, email)
                     VALUES ('$first_name', '$last_name', '" . md5($password) . "', '$email')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
    }
}
} else {

    ?>
<body>
    <form class="form" id= "register" name ="register" action="" method="POST" onsubmit = "return validateRegister()">
        <h1 class="login-title">Register</h1>
        <input type="text" class="login-input" name="first_name" placeholder="First Name" required />
        <input type="text" class="login-input" name="last_name" placeholder="Last Name" required />
        <input type="text" class="login-input" name="email" placeholder="Email Address" required />
        <input type="password" class="login-input" name="password" placeholder="Password"   required />
        <input type="password" class="login-input" name="password_confirmation" placeholder="Confirm Password" required />
        <input type="submit" name="submit" id="register" name = "register" value="Register" class="login-button" onclick="validateform()">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
</body>
<?php
    }
?>
</html>
