


<!-- Register.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php
include 'session-file.php';
include 'database/handlers/register_handler.php';
include 'database/handlers/login_handler.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcome to Ocean</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/register.css">

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
                        <input type="password" name="log_password" placeholder="Password" required> <Br>
                        
                    <!-- remember me -->
                    

                    <?php if(in_array("Email or Password was incorrect", $error_array)) echo "Email or Password was incorrect"; ?>
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
                    <?php if (in_array("Your first name must be between 2 and 25 characters" , $error_array)) echo "Your first name must be between 2 and 25 characters";           
                    ?>

                    <!-- Last Name -->
                    <label>Last name</label>
                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <?php if (in_array("Your last name must be between 2 and 25 characters" , $error_array)) echo "Your last name must be between 2 and 25 characters";           
                    ?>

                    <!-- Username -->
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username (Cannot be changed)" value="<?php if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } ?>" required>
                    <?php
                        if(in_array("Username already exists", $error_array)) echo "Username already exists<br>";
                        else if(in_array("Username must be between 2 and 20", $error_array)) echo "Username must be between 2 and 20<br>";
                        else if(in_array("You username can only contain english characters or numbers", $error_array)) echo "You username can only contain english characters or numbers<br>";
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
                        if (in_array("Email already in use", $error_array)) echo "Email already in use<br>";
                        else if (in_array("Email is invalid format", $error_array)) echo "Email is invalid format<br>";
                        else if (in_array("Email doesn't match", $error_array)) echo "Email doesn't match<br>";
                    ?>

                    <!-- Password -->
                    <label>Password</label>
                    <input type="password" name="reg_password" placeholder="Password" required>
                    
                    <!-- Confirm Password -->
                    <label>Confirm password</label>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <?php 
                        if(in_array("Your passwords doesn't match", $error_array)) echo "You passwords doesn't match<br>";
                        else if(in_array("Your password can only contain english characters or numbers", $error_array)) echo "Your password can only contain english characters or numbers<br>";
                        else if(in_array("Your password must be between 5 and 30 characters or numbers", $error_array)) echo "Your password must be between 5 and 30 characters or numbers<br>";
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
                    <label>Birthday</label>
                    <tr>
                        <td>Birthday
                        &nbsp;&nbsp;
                        <input type="date" name="dob" requred>
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
    		<p> ©2020 All Rights Reserved <BR> Website designed and developed by <strong><U>Sindhiya Mahesh</u> & <u>Shishangiya Keval</U></strong></p>
    	</div>
    </footer>

</body>

</html>