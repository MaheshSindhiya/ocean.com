

<!-- Profile.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php include 'header.php'; 
    //   include 'classes/User.php';
    //   include 'classes/Post.php';

    if(isset($_GET['profile_username'])){
        $username = $_GET['profile_username'];
        $user_detail_query = mysqli_query($con,"select * from users where username='$username'");
        $user_array = mysqli_fetch_array($user_detail_query);
    }
    $num_friends = (substr_count($user_array['friend_array'],","))-1;

    if(isset($_POST['remove_friend'])){
        $user = new User($con, $userLoggedIn);
        $user->removeFriend($username);
    }

    if(isset($_POST['add_friend'])){
        $user = new User($con, $userLoggedIn);
        $user->sendRequest($username);
    }

    if(isset($_POST['accept_request'])){
        header("Location: request.php");
    }    

    if(isset($_POST['send_msg'])){
        header("Location: messages.php?u=$username");
    }
?> 
<style>
    .wreper_left{
        margin-left: 100px;
        margin-top: 30px;
        width: 20%;
    }

    .wreper_right{
        margin-left: 350px;
        margin-top: -40px;
    }

    .left_info_wreper{
        margin-left: 50px;
        line-height: 25px;
        display: flex;
    }
    
</style>
            <div class="profile_top">
            
                <img class="cover" src='<?php echo $user_array['cover_pic']; ?>'>
                <img class="profile" src='<?php echo $user_array['profile_pic']; ?>'>
                <?php $FirstAndLastName = $user_array['first_name']." ". $user_array['last_name'];
                    echo "<span class='FastAndLastName'>".$FirstAndLastName."</span>";
                    $username = $user_array['username'];
                    
                    echo "<span class='username'>@$username</span>";                
                ?>
                <div class="btns" style="display: flex; margin: -15px 500px;">
                    <form action="#" method="POST"> 
                        <button class="message" name="send_msg"><i class="fas fa-comment-alt"></i> Message</button>
                    </form>
                    <form action="<?php echo $username; ?>" method="POST">
                    
                        <?php 
                            
                            $profile_user_obj = new User($con, $username);
                            if($profile_user_obj->isClosed()){
                                header("Location: user_closed.php");
                            }
                            $logged_in_user_obj = new User($con, $userLoggedIn);
                            if($userLoggedIn != $username){
                                if($logged_in_user_obj->isFriend($username)){
                                    echo '<span  class="addFriend"  style="background: #ff5c5c; margin-left: 575px;"><i class="fas fa-user-minus"></i> <input type="submit" style="border: none; background: transparent; color: white; font-size: 14px;" name="remove_friend" value="Remove friend"></span>';
                                }
                                else if ($logged_in_user_obj->didReceiveRequest($username)) {
                                    echo '<span  class="addFriend"  style="background: #73d640; margin-left: 575px;"> <input type="submit" style="border: none; background: transparent; color: white; font-size: 14px;" name="accept_request" value="Accept Request"></span>';
                                }
                                else if ($logged_in_user_obj->didSendRequest($username)) {
                                    echo '<span  class="addFriend"  style="background: #73d640; margin-left: 575px;"> <input type="submit" style="border: none; background: transparent; color: white; font-size: 14px;" value="Request Sent"></span>';
                                }
                                else {
                                    echo '<span style="margin-left: 575px;" class="addFriend" ><i class="fas fa-user-plus"></i> <input type="submit" style="border: none; background: transparent; color: white; font-size: 14px;" name="add_friend" value="Add friend"></span>';
                                }
                            }
                        ?>
                        
                    
                    </form>
                </div>        
            </div>

            <div class="main-coluam">
                <?php                   
                        $username = $user_array['username'];
                        $ret_str = "";
                        $data_query = mysqli_query($con, "SELECT * FROM posts ORDER BY id DESC");

                            while($row = mysqli_fetch_array($data_query)) {
                                $id = $row['id'];
                                $body = $row['body'];
                                $added_by = $row['added_by'];
                                $date_time = $row['date_added'];
                                $imagePath = $row['image'];

                                if($username == $added_by){

                                    // show post/display post
                                    $user_details_query = mysqli_query($con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                                    $user_row = mysqli_fetch_array($user_details_query);
                                    $first_name = $user_row['first_name'];
                                    $last_name = $user_row['last_name'];
                                    $profile_pic = $user_row['profile_pic'];
                                    
                                    ?>
                                    
                                    <script>
                                        function toggle<?php echo $id; ?>(){
                                        
                                        
                                                var element = document.getElementById("toggleComment<?php echo $id; ?>");
                                                
                                                if(element.style.display == "block")
                                                    element.style.display = "none";
                                                else
                                                    element.style.display = "block";
                                            
                                        }
                                    </script>

                                    <?php
                                    // count comments
                                    $comment_check = mysqli_query($con,"select * from comments where post_id='$id'");
                                    $comment_check_num = mysqli_num_rows($comment_check);

                                    $date_time_now = date("Y-m-d H:i:s");
                                    $start_date = new DateTime($date_time); //time of post
                                    $end_date = new DateTime($date_time_now); //curent time
                                    $interval = $start_date->diff($end_date); //difrent between dates
                                    
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
                                    
                                    
                                    $ret_str .= "
                                        <div class='status_post'>                     
                                            <div class='post_profile_pic'>
                                                <img src='$profile_pic' width='50' style='border-radius: 50%;'> 
                                            </div>  
                                            <div class='posted_by' style='color:#ACACAC;'> 
                                                <a href='$added_by'> $first_name $last_name </a> <br> 
                                                <div class='time'> $time_message </div> 
                                            </div> <br> <br> 
                                            <div class='post_body' id='post_body'> 
                                            <span style='margin-left: 34px;'> $body </span> <br> <br> <img src='$imagePath'> <br> 
                                            </div> 
                                        </div>
                                        <div calss='post_feature'>
                                            <span class='comment' style='color: #3875c5; font-size: 12px; float: right; margin-right: 40px; margin-top:-10px;'  onClick='javascript:toggle$id()'><i class='fas fa-comment fa-2x'></i>($comment_check_num)</span>&nbsp;&nbsp;
                                            <iframe src='like.php?post_id=$id'style='
                                            border: 0px;
                                            height: 25px;
                                            width: 120px;
                                            margin-left: 35px;
                                        ' scrolling='no'></iframe>
                                        </div>
                                        <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                            <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' style='display: flex; width: 100%; border-radius: 5px;'></iframe>                                    
                                        </div>
                                        <hr style='margin-bottom: 28px;'> ";
                                }//end if

                            }//end of loop
                            
                        echo $ret_str;                  
                  
                ?>
            </div>
            
            <div class="profile_left">
                <div class="left_wreper">
                    <div class="wreper_top">
                        <center><h2> <?php echo $FirstAndLastName ?> </h2></center>
                        <center><span> @<?php echo $username ?> </span></center>
                    </div>
                    <hr>
                    <div class="wreper_left">
                        <div class="post"> <b> Posts </b> </div> <br>
                        <div class="num_post"  style="margin-left: 15px;"> <?php echo $user_array['num_posts']  ?> </div>
                    </div>
                    <hr style="transform: rotate(90deg); margin-top: -19px; width: 75px;">
                    <div class="wreper_right">
                        <div class="post"> <b> Friends </b> </div> <br>
                        <div class="num_friend" style="margin-left: 15px;"> <?php echo $num_friends  ?> </div>
                    </div>
                </div>
            </div>

            <!-- <div class="left_info">
                <div class="left_info_wreper">
                    <div class="lable"> Bio <br>   
                     e-Mail   <br>
                     Ph. no.   <br>
                     country   <br>
                     city  <br>
                     </div>  
                     <div class="op" style="margin-left: 60px;">
                        <?php echo $user_array['bio'] ?> <br>
                        <?php echo $user_array['email'] ?> <br>
                        <?php echo $user_array['phone'] ?> <br>
                        <?php echo $user_array['country'] ?> <br>
                        <?php echo $user_array['city'] ?> <br>
                     </div>
                </div>
            </div> -->

        </div>

    </body>

</html>

