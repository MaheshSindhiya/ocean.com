


<!-- Request.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php  include 'header.php'; 
    //   include 'classes/User.php';
    //   include 'classes/Post.php';
?>
<style>
    .main_column{
        width: 700px;
        background: white;
        margin-top: 95px;
        margin-bottom: 150px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 5px;
        padding-top: 1px;
        padding-bottom: 30px;
        padding-left: 20px;
    }
    #accept{
        background: #0090ff;
        border: none;
        border-radius: 3px;
        padding: 5px 10px;
        margin-top: 5px;
        color: white;
    }

    #reject{
        background: darkorange;
        border: none;
        border-radius: 3px;
        padding: 5px 10px;
        margin-top: 5px;
        color: white;
    }

    #pro_pic{
        height: 55px;
        width: 55px;
        border-radius: 50%;
    }

    .name{
        margin-left: 65px;
        margin-top: -52px;
        margin-bottom: auto;
    }

    hr{
        margin-top: 13px;
        width: 350px;
       
    }


</style>

    <div class="main_column">
    
        <h4> Friend Request </h4>

        <div class="request_inner">

            <?php 
            
            $query = mysqli_query($con, "select * from friend_requests where user_to='$userLoggedIn'");
            if(mysqli_num_rows($query)==0){
                echo "No friend request";
            }
            else{

                while($row = mysqli_fetch_array($query)){
                    $user_from = $row['user_from'];
                    $get_pic_query = mysqli_query($con, "select * from users where username='$user_from'");
                    $get_pic = mysqli_fetch_array($get_pic_query);
                    $request_pic = $get_pic['profile_pic'];
                    $user_from_obj = new User($con, $user_from);
                    echo "<br><img id='pro_pic' src='".$request_pic."'><br><div class='name'>" . $user_from_obj->getFnameAndLname();
                    $user_from_friend_array = $user_from_obj->getFriendArray();

                    if (isset($_POST['accept'.$user_from])) {
                        $add_friend_query = mysqli_query($con, "update users set friend_array=CONCAT(friend_array, '$user_from,') where username='$userLoggedIn'");
                        $add_friend_query = mysqli_query($con, "update users set friend_array=CONCAT(friend_array, '$userLoggedIn,') where username='$user_from'");

                        $delete_query = mysqli_query($con, "delete from friend_requests where user_to='$userLoggedIn' and user_from='$user_from'");

                        echo $user_from . " and YOU are friend now!";
                        header("Location: request.php");

                    }
                    if (isset($_POST['reject'. $user_from])) {
                        $delete_query = mysqli_query($con, "delete from friend_requests where user_to='$userLoggedIn' and user_from='$user_from'");

                        echo "Request Denied!";
                        header("Location: request.php");
                    }

                    ?>

                    <form action="request.php" method="POST">

                        <input type="submit" name="accept<?php echo $user_from ?>" id="accept" value="Accept">
                        <input type="submit" name="reject<?php echo $user_from ?>" id="reject" value="Reject"><br>
                        

                    </form>
                    </div>
                    <?php
                }
            }
            ?>

        </div>


    </div>