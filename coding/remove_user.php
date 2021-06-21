


<!-- Remove user.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

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
    if(isset($_POST['search_user_btn']))
    {
        $user = $_POST['search'];
        $query = mysqli_query($con, "delete from users where username='$user'") or die("No User Found");
        $post_query = mysqli_query($con, "delete from poste where added_by='$user'")or die("can not Delete posts");
        if($query){
            echo "User $user is Deleted with his/her all posts";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove User</title>
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
    <form action="remove_user.php" method="post">
        <input type="text" name="search" placeholder="Enter User Name to remove....">
        <input type="submit" name="search_user_btn" value="Remove">
    </form>
</body>
</html>