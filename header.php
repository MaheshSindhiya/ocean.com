<!-- Header.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php 

    include 'session-file.php';
    include 'classes/User.php';
    include 'classes/Post.php';
    include 'classes/Message.php';

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }
    elseif ($userLoggedIn == 'admin') {
        header("Location: admin_home.php");
    }
    else{
        header("Location: register.php");
    }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link allfiles -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script> <style src="assets/js/jquery-3.5.1.min.js"> </style> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="images/favigon.jpg" type="image/x-icon">

    <title>Ocean</title>
</head>
<body>

<div class="header_bar">
    <a href="index.php" style="text-decoration: none; color: #44c2d8;"><img src="images/favigon.jpg" alt="O" style="height: 40px; width: 40px; margin: 18px 3px -10px 30px;">
    <span style="font-family: Roboto;/*! text-decoration: none; */font-size: 26px;">CEAN</span></a>
    
  <div class="nav-center">
      <div class="dropdown">
        <span><img src="<?php echo $user['profile_pic']; ?>" style="margin-bottom: 3px;"></span>
        <div class="dropdown-content">
            <div class="dropdown-a">
                <h5><a href="<?php echo $userLoggedIn; ?>">
                       <?php echo "@".$user ['username']?></a></h5>
                                
                <a href="request.php"> <i class="fas fa-user-plus fa-lg" style="margin-right: 3px;"></i> Requests</a>
                <?php    
                    $user_obj = new User($con, $userLoggedIn);
                    $num_requast = $user_obj->getNumbreOfRequest();
                    if ($num_requast > 0){
                        echo "
                            <div class='notification_count' style='background: red; height: 20px; width: 20px; border-radius: 50%; color: white; display: grid; position: relative; margin: -20px 0px 0px 135px;'>
                                <span style='font-size: 10px; text-align: center; margin: 2px 0 0 0;'>"
                                    . $num_requast .
                                "</span>        
                            </div>
                        ";
                    }         
                ?>
                
                <hr>
                
                <a href="account_settings.php"> <i class="fas fa-cog fa-lg" style="margin-right: 3px;"></i> Settings</a>

                <hr>

                <a href="logout.php"> <i class="fas fa-sign-out-alt fa-lg" style="margin-right: 3px;"></i> Logout</a>
            </div>
        </div> 
        <?php echo "<br>"."Hello ".$user['first_name']; ?><?php echo "!";?> 
        
      </div>
  </div>
  
  
  <nav>
        

        <a href="index.php"> <i class="fas fa-home fa-lg"></i></a>
        <a href="messages.php"> <i class="fas fa-envelope fa-lg"></i></a>
        <?php    
            $message_obj = new Message($con, $userLoggedIn);
            $num_msg = $message_obj->getUnreadNumber();
            if ($num_msg > 0){
                echo "
                    <div class='notification_count' style='background: red; height: 20px; width: 20px; border-radius: 50%; color: white; display: grid; position: relative; margin: -30px 0px 0px 60px;'>
                        <span style='font-size: 10px; text-align: center; margin: 2px 0 0 0;'>"
                            . $num_msg .
                        "</span>        
                    </div>
                ";
            }         
        ?>
  </nav>
  
</div>
