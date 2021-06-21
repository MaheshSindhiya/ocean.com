


<!-- Remove msg.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->


<?php

    include 'session-file.php';
    include 'database/classes/User.php';
    include 'database/classes/Post.php'; 

    $userLoggedIn = $_SESSION['username'];
    if(isset($_SESSION['username'])){
        $user_details_query = mysqli_query($con, "SELECT * FROM admin WHERE adminname='$userLoggedIn'")or die(mysqli_error($con));
        $user = mysqli_fetch_array($user_details_query);
    }
    else{
        header("Location: admin.php");
    }

?>

<?php
    if(isset($_POST['search_msg_btn']))
    {
        $msg = $_POST['search'];
        $query = mysqli_query($con, "delete from messages where id='$msg'") or die("No msg Found");
        if($query){
            echo "msg no. $msg is Deleted";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Post</title>
    <style>
        input[type="text"]{
            width: 70%;
            height: 25px;
            padding: 5px;
            border-radius: 5px;
            border: none;
            background: #eeeeee;
            padding-left: 10px;
        }

        input[type="submit"]{
            padding: 5px 10px;
            background: #7a6bff;
            border: none;
            border-radius: 3px;
            color: white;
            height: 32px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <form action="remove_msg.php" method="post">
        <input type="text" name="search" placeholder="Enter Message ID to remove....">
        <input type="submit" name="search_msg_btn" value="Remove">
    </form>
</body>
</html>