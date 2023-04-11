


<!-- Register.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php
include 'session-file.php';

include 'handlers/register_handler.php';
include 'handlers/login_handler.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcome to Ocean</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .alert{
            color: red;
            margin: auto;
        }
        .pswd_icon_bg{
            background: white;
            height: 32px;
            width: 30px;
            position: absolute;
            display: flex;
            align-content: center;
            overflow: hidden;
            margin: 0 0 0 525px;
        }
    </style>


    <!-- favigon -->
    <link rel="shortcut icon" href="images/favigon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
   
    <div class="top-content">
        <h1 style="font-size:35px;">Wellcome to Ocean, share your moments with friends!</h1>
        <p>Sign up and start sharing your photos and updates with your friends.
        </p>
        <hr style="width: 50%; color: white; margin-bottom:25px; margin-top:25px;">
    </div>

    <div class="wreper">
        <div class="signin-form">
            <div class="form-top-left">
                <h3 style="padding-top:10px;">Login to our site</h3>
                <p style="margin-top:-20px; padding-bottom:10px;">Enter Email and password to log on:</p>
            </div>
            <div class="form-bottom">
                <form action="register.php" method="POST" class="login-form">
                    <!-- Email Addresss -->
                        <label for="form-email">Email Address</label>
                        <input type="email" name="log_email" placeholder="Email Address" value="<?php if(isset($SESSION['log_email'])) {
                            echo $_SESSION['log_email'];
                        } ?>" required> <br>
                                            
                    <!-- Password -->
                        <label for="form-password">Password</label>
                        <span class="pswd_icon_bg"  onclick="log_pswd_toggale()"><i class="fa-regular fa-eye" id="pswd_show" style="margin: auto;"></i></span>
                        <input type="password" id="login_pswd" name="log_password" placeholder="Password" required> <Br>
                        
                    <!-- remember me -->
                    

                    <?php if(in_array("Email or Password was incorrect", $error_array_login)) echo "<p class='alert'>Email or Password was incorrect</p>"; ?>
                    <button type="submit" style="margin-bottom:20px" name="login_button">Sign in!</button>
                </form>     
            </div>
        </div>

        <hr style="height:300px; color:white; margin-top:110px;">

        <div class="signup-form">
            <div class="form-top-left">
                <h3 style="padding-top:10px;">Sign up now</h3>
                <p style="margin-top:-20px; padding-bottom:10px;">Fill in the form below to get instant access:</p>
            </div>
            <div class="form-bottom">
                <form action="register.php" method="POST">

                    <!-- First Name -->
                    <label>First name</label>
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php if (isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    } ?>" required>
                    <?php if (in_array("Your first name must be between 2 and 25 characters" , $error_array)) 
                          {
                              echo "<p class='alert'>Your first name must be between 2 and 25 characters</p>";
                          }           
                    ?>

                    <!-- Last Name -->
                    <label>Last name</label>
                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <?php if (in_array("Your last name must be between 2 and 25 characters" , $error_array)) echo "<p class='alert'>Your last name must be between 2 and 25 characters</p>";           
                    ?>

                    <!-- Username -->
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username (Cannot be changed)" value="<?php if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } ?>" required>
                    <?php
                        if(in_array("Username already exists", $error_array)) echo "<p class='alert'>Username already exists</p>";
                        else if(in_array("Username must be between 2 and 20", $error_array)) echo "<p class='alert'>Username must be between 2 and 20</p>";
                        else if(in_array("You username can only contain english characters or numbers", $error_array)) echo "<p class='alert'>You username can only contain english characters or numbers</p>";
                    ?>

                    <!-- Email -->
                    <label>Email</label>
                    <input type="email" name="reg_email" placeholder="Email" value="<?php if (isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    } ?>" required>

                    <!-- Confirm Email -->
                    <label>Confirm Email</label>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    } ?>" required>
                    <?php
                        if (in_array("Email already in use", $error_array)) echo "<p class='alert'>Email already in use</p>";
                        else if (in_array("Email is invalid format", $error_array)) echo "<p class='alert'>Email is invalid format</p>";
                        else if (in_array("Email doesn't match", $error_array)) echo "<p class='alert'>Email doesn't match</p>";
                    ?>

                    <!-- Password -->
                    <label>Password</label>
                    <span class="pswd_icon_bg"  onclick="reg_pswd_toggale()"><i class="fa-regular fa-eye" id="reg_pswd_show" style="margin: auto;"></i></span>
                    <input type="password" id="register_pswd" name="reg_password" placeholder="Password"  required>
                    <?php 
                        
                    ?>
                    
                    <!-- Confirm Password -->
                    <label>Confirm password</label>
                    <span class="pswd_icon_bg"  onclick="reg_conf_pswd_toggale()"><i class="fa-regular fa-eye" id="reg_conf_pswd_show" style="margin: auto;"></i></span>
                    <input type="password" id="register_conferm_pswd" name="reg_password2" placeholder="Confirm Password" required>
                    <?php 
                        if(in_array("Your passwords doesn't match", $error_array)) echo "<p class='alert'>You passwords doesn't match</p>";
                        else if(in_array("Your password can only contain english characters or numbers", $error_array)) echo "<p class='alert'>Your password can only contain english characters or numbers</p>";
                        else if(in_array("Your password must be between 5 and 30 characters or numbers", $error_array)) echo "<p class='alert'>Your password must be between 5 and 30 characters or numbers</p>";
                    ?>

                    <!-- Gender -->
                    <label>Gender</label>
                    <tr>
                        <td>
                            <input style="width:10px; height:10px;" type="radio" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male"){
                            ?> checked <?php
                            } ?> required> Male
                            <input style="width:10px; height:10px;" type="radio" name="gender" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female"){
                            ?> checked <?php
                            } ?> required> Female
                        </td>
                    </tr>

                    <!-- Birthday -->
                    <br>      
                    <!-- <label>Birthday</label> -->
                    <tr>
                        <td>Birthday
                        &nbsp;&nbsp;
                        <input type="date" name="dob" value="<?php if (isset($_SESSION['dob'])) {
                            echo $_SESSION['dob'];
                        } ?>" requred>
                        </td>
                    </tr>
                    

                    <!-- Submit Button -->
                    <button type="submit"  style="margin-bottom:20px" name="reg_user" >Sign me up!</button>         
                    
                </form>
            </div>
        </div>
    </div>

    <hr style="color:white; margin-top:265px; width:40%;">

    <!-- Footer -->
    <footer>			
    	<div class="footer"> 
            <a style="text-decoration-line: none; color: #977AFF;" href="admin.php"><i class="fas fa-user-shield"></i> Admin? click here <i class="fas fa-arrow-right"></i></a>
    		<p> ©2020 All Rights Reserved <BR> Website designed and developed by <strong><U>Sindhiya Mahesh</u></strong></p>
    	</div>
    </footer>

    <script>
        function log_pswd_toggale() {
            var x = document.getElementById("login_pswd");
            var img = document.getElementById("pswd_show");
            if (x.type === "password") {
                img.className = "fa-regular fa-eye-slash"
                x.type = "text";
            } else {
                img.className = "fa-regular fa-eye"
                x.type = "password";
            }
        }
        function reg_pswd_toggale() {
            var y = document.getElementById("register_pswd");
            var img = document.getElementById("reg_pswd_show");
            if (y.type === "password") {
                img.className = "fa-regular fa-eye-slash"
                y.type = "text";
            } else {
                img.className = "fa-regular fa-eye"
                y.type = "password";
            }
        }
        function reg_conf_pswd_toggale() {
            var z = document.getElementById("register_conferm_pswd");
            var img = document.getElementById("reg_conf_pswd_show");
            if (z.type === "password") {
                img.className = "fa-regular fa-eye-slash"
                z.type = "text";
            } else {
                img.className = "fa-regular fa-eye"
                z.type = "password";
            }
        }
    </script>

</body>

</html>