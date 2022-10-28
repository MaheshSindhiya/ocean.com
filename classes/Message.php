<!-- Message.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php 

    class Message {
        private $user_obj;
        private $con;
        
        public function __construct($con, $user){
            $this->con = $con;
            $this->user_obj = new User($con, $user);
        }

        public function getMostRecentUser(){
            $userLoggedIn = $this->user_obj->getUserName();
            $query = mysqli_query($this->con, "select user_to, user_from from messages where user_to='$userLoggedIn' or user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");
            
            if(mysqli_num_rows($query)==0)
                return false;
            $row = mysqli_fetch_array($query);
            $user_to = $row['user_to'];
            $user_from = $row['user_from'];

            if ($user_to != $userLoggedIn)
                return $user_to;
            else
                return $user_from;

        }

        public function getLastMsg($userLoggedIn, $otheruser){
            $info_array = array();

            $query = mysqli_query($this->con, "select body, user_to, date from messages where (user_to='$userLoggedIn' and user_from='$otheruser') or (user_from='$userLoggedIn' and user_to='$otheruser') ORDER BY id DESC LIMIT 1");

            $row = mysqli_fetch_array($query);
            $sent_by = ($row['user_to'] == $userLoggedIn) ? "They said: " : "You said: ";

            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($row['date']); //time of post
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

            array_push($info_array, $sent_by);
            array_push($info_array, $row['body']);
            array_push($info_array, $time_message);

            return $info_array;
        }

        public function sendMessage($user_to, $body, $date){
            if ($body != "") {            
                $userLoggedIn = $this->user_obj->getUsername();
                $query = mysqli_query($this->con, "insert into messages values('','$user_to','$userLoggedIn','$body','$date','no','no','no')")or die(mysqli_error($this->con));
            }

        }

        public function getMessages($otheruser){
            $userLoggedIn = $this->user_obj->getUsername();
            $data = "";
            $query = mysqli_query($this->con, "update messages set opened='yes' where user_to='$userLoggedIn' and user_from='$otheruser'");

            //geting the msgs of both user (sender and reciver)
            $get_msg_query = mysqli_query($this->con, "select * from messages where (user_to='$userLoggedIn' and user_from='$otheruser') or (user_from='$userLoggedIn' and user_to='$otheruser')");

            while ($row = mysqli_fetch_array($get_msg_query)) {
                $user_to = $row['user_to'];
                $user_from = $row['user_from'];
                $body = $row['body'];


                $div_top = ($user_to == $userLoggedIn) ? "<div class='msg' id='green'>" : "<div class='msg' id='blue'>";//condisnal/ternary operator( e1 ? c1 : c2 )
                $data = $data.$div_top.$body."</div><br><br>";
            }
            return $data;
        }

        public function getOtherChats(){
            $userLoggedIn = $this->user_obj->getUsername();
            $return_string = "";

            $chat = array();

            $query = mysqli_query($this->con, "select user_to, user_from from messages where user_to='$userLoggedIn' or user_from='$userLoggedIn'");
            while ($row = mysqli_fetch_array($query)) {
                $user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from']; 
                if (!in_array($user_to_push, $chat)) {
                    array_push($chat, $user_to_push);
                }
            }

            foreach($chat as $username){
                $user_found_obj = new User($this->con, $username);
                $last_msg_detail = $this->getLastMsg($userLoggedIn, $username);

                $dots = (strlen($last_msg_detail[1] >= 12)) ? "..." : "";
                $split = str_split($last_msg_detail[1], 12);
                $split = $split[0] . $dots;

                $return_string .= "<a href='messages.php?u=$username'> <div class='user_found_msg'> <div class='img'>
                                    <img src='".$user_found_obj->getProfilePic()."' style='margin-right: 7px; height:50px; width: 50px; border-radius: 7px;'></div> <div class='chat_name'>
                                    ".$user_found_obj->getFnameAndLname()."</div> <div class='other'>
                                    <span class='time_sml' id='grey'>".$last_msg_detail[2]."</span>
                                    <p class='chat_p'>".$last_msg_detail[0].$split."</p></div>
                                    </div>
                                    </a><hr> ";
            }

            return $return_string;
        }

        public function getUnreadNumber(){
            $userLoggedIn = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "select * from messages where opened='no' and user_to='$userLoggedIn'");
            return mysqli_num_rows($query);
        }

    }

?>