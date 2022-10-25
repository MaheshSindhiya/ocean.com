
<!-- Session-file.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php


ob_start();
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

$con = mysqli_connect("localhost","root","","ocean");

if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}
// else{
//     echo'Connected';
// }

?>