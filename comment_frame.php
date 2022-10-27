
<!-- Comment Fream.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    
    <?php
    
        include 'session-file.php';
        include 'classes/User.php';
        include 'classes/Post.php'; 
    
        if(isset($_SESSION['username'])){
            $userLoggedIn = $_SESSION['username'];
            $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
            $user = mysqli_fetch_array($user_details_query);
        }
        else{
            header("Location: register.php");
        }
    ?>
    
    <script>
        function toggle(){
            var element = document.getElementById("comment_section");
            if(element.style.display == "block")
                element.style.display = "none";
            else{
                element.style.display = "block";
            }
        }
    </script>
    
    <?php
    
    if (isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
    }
    
    $user_query = mysqli_query($con, "SELECT added_by FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($user_query);
    
    $posted_to = $row['added_by'];
    
    if (isset($_POST['postComment' . $post_id])){
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        $date_time_now = date ("Y-m-d H:i:s");
        $insert_post = mysqli_query($con, "INSERT INTO comments (post_body, posted_by, posted_to, date_added, removed, post_id) VALUES ('$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', '$post_id')") or die("cannot inset".mysqli_error($con));
        echo "<div style='color:green;' class='comment_posted'> Comment Posted! </div>";
    }
    
    ?>
    
    <form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="post">
        <textarea name="post_body" style="width: 83%; border: none; border-radius: 5px; padding: 10px 0 0 10px;"></textarea>
        <input class="post-comment" type="submit" name="postComment<?php echo $post_id; ?>" value="Comment" style="padding: 5px 10px 5px 10px; background: cornflowerblue; border: none; border-radius: 5px; color: white; margin-left: 10px; position: absolute; height: 28%;">     
    </form>

    <?php

        $get_comments = mysqli_query ($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC");
        $count = mysqli_num_rows($get_comments);
        
        if($count != 0){
            while ($comment = mysqli_fetch_array($get_comments)){
                $comment_body = $comment['post_body'];
                $posted_to = $comment['posted_to'];
                $posted_by = $comment['posted_by'];
                $date_added = $comment['date_added'];
                $removed = $comment['removed'];
                
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_added);
                $end_date = new DateTime($date_time_now);
                $interval = $start_date->diff($end_date);
    
                if($interval->y >= 1){
                    if($interval == 1)
                        $time_message = $interval->y . " year ago";
                    else
                        $time_message = $interval->y . " years ago";
                }
                else if($interval->m >= 1){
                    if($interval->d == 0){
                        $days = " ago";
                    }
                    else if($interval->d == 1){
                        $days = $interval->d . " day ago";
                    }
                    else{
                        $days = $interval->d . " days ago";
                    }
    
                    if($interval->m == 1){
                        $time_message = $interval->m . " month" .
                        $days;
                    }
                    else{
                        $time_message = $interval ->m . " months".
                        $days;
                    }
                }
    
                else if($interval->d >= 1){
                    if($interval->d == 1){
                        $time_message = "Yesterday";
                    }
                    else{
                        $time_message = $interval->d . " days ago";
                    }
                }
    
                else if($interval->h >= 1){
                    if($interval->h == 1){
                        $time_message = $interval->h . " hour ago";
                    }
                    else{
                        $time_message = $interval->h . " hours ago";
                    }
                }
    
                else if($interval->i >= 1){
                    if($interval->i == 1){
                        $time_message = $interval->i . " minute ago";
                    }
                    else{
                        $time_message = $interval->i . " minutes ago";
                    }
                }
    
                else{
                    if($interval->s < 30){
                        $time_message = "Just Now";
                    }
                    else{
                        $time_message = $interval->s . " seconds ago";
                    }
                }
                
                $user_obj = new User($con, $posted_by);
                ?>
                <!-- show post comments -->
                <div class="comment_section">
                    <a href="<?php echo $posted_by?>" target="_parent"><img src="<?php echo $user_obj->getProfilePic(); ?>" title="<?php echo $posted_by; ?>"style="float:left; margin-right:5px; border-radius: 50%; height: 35px; width: 35px" height="30"></a>
                    <a href="<?php echo $posted_by?>" target="_parent">
                        <?php echo $user_obj->getFnameAndLname(); ?></a>
                        <br> <?php echo "<div style=\"color:#5D6D7E;\">$time_message</div>" . "<br>" .
                        "<div class='comment_body'>$comment_body</div>" ?> <hr style="width: 100%; margin:5px 0 5px 0;">
                </div>

                <?php
            }
        }
        else {
            echo "<center><br> NO Comments to show !</center>";
        }
    ?> 

</body>
</html>