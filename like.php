

<!-- Like.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.1-web/css/all.css">
    <style type="text/css">
    body{
        background: #fff;
    }

    </style>
</head>
<body>

    <?php
        
        include 'session-file.php';
        include 'database/classes/User.php';
        include 'database/classes/Post.php'; 

        if(isset($_SESSION['username'])){
            $userLoggedIn = $_SESSION['username'];
            $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
            $user = mysqli_fetch_array($user_details_query);
        }
        else{
            header("Location: register.php");
        }

        if (isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
        }

        $get_like = mysqli_query($con, "select likes, added_by from posts where id='$post_id'");
        $row = mysqli_fetch_array($get_like);
        $total_likes = $row['likes'];
        $user_liked = $row['added_by'];

        $user_details_query = mysqli_query($con, "select * from users where username='$user_liked'");
        $row = mysqli_fetch_array($user_details_query);
        $total_user_likes = $row['num_likes'];

        //like button
        if(isset($_POST['like_btn'])){
            $total_likes++;
            $query = mysqli_query($con, "update posts set likes='$total_likes' where id='$post_id'")or die(mysqli_error($con));
            $total_user_likes++;
            $user_likes = mysqli_query($con, "update users set num_likes='$total_user_likes' where username='$user_liked'");
            $insert_query = mysqli_query($con, "insert into likes values('','$userLoggedIn','$post_id')");
        }

        //unlike button
        if(isset($_POST['unlike_btn'])){
            $total_likes--;
            $query = mysqli_query($con, "update posts set likes='$total_likes' where id='$post_id'");
            $total_user_likes--;
            $user_likes = mysqli_query($con, "update users set num_likes='$total_user_likes' where username='$user_liked'");
            $insert_query = mysqli_query($con, "delete from likes where username='$userLoggedIn' and post_id='$post_id'");
        }

        //chech previus likes
        $check_query = mysqli_query($con, "select * from likes where username='$userLoggedIn' AND post_id='$post_id'")or die(": ( ".mysqli_error($con));
        $num_rows = mysqli_num_rows($check_query);

        if($num_rows > 0){ //unlike button
            echo '<form action="like.php?post_id='. $post_id . '" method="POST" style="position: absolute; top: 0;">
            <input type="submit" class="comment_like" name="unlike_btn" value="Unlike" style="background: #3875C5; border: none; border-radius: 3px; padding: 3px 10px 3px 10px; color: white;">
                    <div class="like_value" style="display: inline;">
                        ('. $total_likes . ')
                    </div>
                </form>
            ';
        }

        else { //like button
            echo '<form action="like.php?post_id='. $post_id . '" method="POST" style="position: absolute; top: 0;">
                    <input type="submit" class="comment_like" name="like_btn" value="like" style="background: #3875C5; border: none; border-radius: 3px; padding: 3px 10px 3px 10px; color: white;">
                    <div class="like_value" style="display: inline;">
                        ('. $total_likes . ')
                    </div>
                </form>
            ';
        }

    ?>


</body>
</html>