<!-- User.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php 

    class User{
        private $user;
        private $con;

        public function __construct($con, $user){
            $this->con = $con; //this -> con = private $con (connection)
            $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
            $this->user = mysqli_fetch_array ($user_details_query); //this -> user = private $user (hold query)
        }

        public function getUsername(){
            return $this->user['username'];
        }

        public function getNumPosts(){
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['num_posts'];
        }
        
        public function getFnameAndLname(){
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['first_name'] . " " . $row['last_name'];
        }

        public function getProfilePic(){
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['profile_pic'];
        }

        public function isClosed() {
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
    
            if($row['user_closed'] == 'yes')
                return true;
            else 
                return false;
        }

        public function getFriendArray() {
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['friend_array'];
        }

        public function isFriend($username_to_check) {
            $usernameComma = "," . $username_to_check . ",";
    
            if((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
                return true;
            }
            else {
                return false;
            }
        }

        public function didReceiveRequest($user_from){
            $user_to = $this->user['username'];
            $check_request_query = mysqli_query($this->con, "select * from friend_requests where user_to='$user_to' and user_from='$user_from'");
            if(mysqli_num_rows($check_request_query) > 0){
                return true;
            }
            else {
                return false;
            }
        }

        public function didSendRequest($user_to){
            $user_from = $this->user['username'];
            $check_request_query = mysqli_query($this->con, "select * from friend_requests where user_to='$user_to' and user_from='$user_from'")or die(mysqli_error($this->con));
            if(mysqli_num_rows($check_request_query) > 0){
                return true;
            }
            else {
                return false;
            }
        }

        public function removeFriend($user_to_remove){
            $logged_in_user = $this->user['username'];

            $query = mysqli_query($this->con, "select friend_array from users where username='$user_to_remove'");
            $row = mysqli_fetch_array($query);
            $friend_array_username = $row['friend_array'];
            
            //removinf target_user from logged_in_user
            $new_friend_array = str_replace($user_to_remove.",","",$this->user['friend_array']);
            $remove_friend = mysqli_query($this->con, "update users set friend_array='$new_friend_array' where username='$logged_in_user'");

            //remove logged_in_user from target_user
            $new_friend_array = str_replace($this->user['username'].",","",$friend_array_username);
            $remove_friend = mysqli_query($this->con, "update users set friend_array='$new_friend_array' where username='$user_to_remove'");
        }

        public function sendRequest($user_to){
            $user_from = $this->user['username'];
            $query = mysqli_query($this->con, "insert into friend_requests values('','$user_to','$user_from')");
        }

        public function getFolovers($user_to_check){
            $folovers = 0;
            $user_array = $this->user['friend_array'];
            $user_array_explode = explode(",",$user_array); //explode is function to sepret the string into array at given_value
        }

        public function getNumbreOfRequest(){
            $userLoggedIn = $this->user['username'];
            $query = mysqli_query($this->con, "select * from friend_requests where user_to='$userLoggedIn'");
            return mysqli_num_rows($query);
        }

    }



?>