<!-- Post.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php 

    class Post{
        private $user_obj;
        private $con;
        
        public function __construct($con, $user){
            $this->con = $con;
            $this->user_obj = new User($con, $user);
        }
        
        public function submitPost($body, $imageName){
            $body = strip_tags($body); //remove thigs like <,>...etc tages
            $body = mysqli_real_escape_string($this->con, $body); //egnore the ' in post boddy
            $check_empty = preg_replace('/\s+/', '', $body); //deletes all spaces
            
            if($check_empty != ""){
                $body_array = preg_split("/\s+/", $body);
                $body = implode(" ", $body_array);
                
                //curentdate and time
                $date_added = date("Y-m-d H:i:s");
                
                //get username 
                $added_by = $this->user_obj->getUsername();
                
                //insert post to database
                $query = mysqli_query($this->con, "INSERT INTO posts (body, added_by, date_added, user_closed, deleted, likes, image) VALUES('$body', '$added_by', '$date_added', 'no', 'no', '0', '$imageName')");

                //returns the id of iserted post
                $returned_id = mysqli_insert_id($this->con);
                
                //incereas the post no of usr 
                $num_posts = $this->user_obj->getNumPosts();
                $num_posts++;
                $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
            }
        }

        public function indexPosts () {
          
            $ret_str = "";
            $data_query = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC");
    
                while($row = mysqli_fetch_array($data_query)) {
                    $id = $row['id'];
                    $body = $row['body'];
                    $added_by = $row['added_by'];
                    $date_time = $row['date_added'];
                    $imagePath = $row['image'];

                    // show post only from the friends 
                    // $userLoggedIn = $_SESSION['username'];
                    // $user_logged_obj = new User($this->con, $userLoggedIn);
				    // if($user_logged_obj->isFriend($added_by)){

                        // show post/display post
                        $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
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
                        $comment_check = mysqli_query($this->con,"select * from comments where post_id='$id'");
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
                                    <img src='$profile_pic' width='50'> 
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
                                <div class='comImg_comCount' style='display: flex; float: right; margin: 0 40px;'>
                                    <span class='comment' onClick='javascript:toggle$id()'><img src='assets/images/comment.png' height='30px'></span> 
                                    <span style='margin: 5px 5px;'>($comment_check_num)</span>&nbsp;&nbsp;
                                </div>
                                <iframe src='like.php?post_id=$id'style='border: 0px; height: 25px; width: 120px; margin-left: 35px;' scrolling='no'></iframe>
                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' style='display: flex; width: 100%; border-radius: 5px;'></iframe>                                    
                            </div>
                            <hr style='margin-bottom: 28px;'> ";
                    // }//end if              
                }//end of loop
                
            echo $ret_str;
        }//end indexpost

       

    }//end class
?>