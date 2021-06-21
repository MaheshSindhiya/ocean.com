<!-- Admin Home.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php 
    include 'session-file.php';

    $userLoggedIn = $_SESSION['username'];
    if(isset($_SESSION['username'])){
        $user_details_query = mysqli_query($con, "SELECT * FROM admin WHERE adminname='$userLoggedIn'")or die(mysqli_error($con));
        $user = mysqli_fetch_array($user_details_query);
    }
    else{
        header("Location: admin.php");
    }

     $user_detail_query = mysqli_query($con,"select * from admin where adminname='$userLoggedIn'");
     $user_array = mysqli_fetch_array($user_detail_query);

     //total users
     $count_user_query = mysqli_query($con,"select * from users");
     $count_user = mysqli_num_rows($count_user_query);

     //total posts
     $count_post_query = mysqli_query($con,"select * from posts");
     $count_post = mysqli_num_rows($count_post_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.1-web/css/all.css">
    <link rel="shortcut icon" href="images/favigon.jpg" type="image/x-icon">
    <title>Home</title>

    <style>    
    @font-face{
        font-family: 'roboto';
        src: url('assets/fonts/Roboto-MediumItalic.ttf');
    }
    body{
        line-height: 17px;
        background-color: #EEEEEE;
        font-family: Roboto;
    }
    .total{
        display: flex;
    }
    input[type="button"]{
        margin: 10px;
        padding: 4px 25px;
        border: none;
        background: linear-gradient(45deg, #b8fb2d, #5cf3d0);
        border-radius: 5px;
        color: white;
        font-size: 18px;
    }
    .t_user{
        background: cadetblue;
        width: 260px;
        height: 150px;
        line-height: 35px;
        margin: 10px;
        align-items: center;
        border-radius: 10px;
        margin-left: 100px;
    }
    .t_post{
        background: cadetblue;
        width: 260px;
        height: 150px;
        line-height: 35px;
        margin: 10px;
        align-items: center;
        border-radius: 10px;
        margin-left: 100px;
    }
    .l_user,.l_post,.l_msg,.l_comment{
        width: 30%;
        background: #7a6bff;
        margin-bottom: 15px;
        height: 45px;
        border-radius: 5px;
        border: none;
        font-size: 20px;
        color: white;
        font-family: system-ui;
    }
    .heading{
        background: gold;
        width: 70%;
        height: 50px;
        padding: 18px 20px 0px 20px;
        border-radius: 5px;
        margin-bottom: 40px;
    }
    button{
        float: right;
        border: none;
        font-size: 14px;
        padding: 5px 12px;
        border-radius: 4px;
        color: gold;
        background: white;
    }
    iframe{
        display: flex;
        width: 45%;
        height: 55px;
        border: 2px solid;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .page_wreper{
        height: auto;
        width: 800px;
        background: white;
        margin-top: 20px;
        padding: 34px;
        border-radius: 5px;
        border: 2px solid #d3d3d3;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>
<body>

    <script>
        function show(){
            var element = document.getElementById("remove");

            if(element.style.display == "block")
                element.style.display = "none";
            else
                element.style.display = "block";
        }
        function show2(){
            var element = document.getElementById("remove_post");

            if(element.style.display == "block")
                element.style.display = "none";
            else
                element.style.display = "block";
        }
        function show3(){
            var element = document.getElementById("remove_msg");

            if(element.style.display == "block")
                element.style.display = "none";
            else
                element.style.display = "block";
        }
        function show4(){
            var element = document.getElementById("remove_comment");

            if(element.style.display == "block")
                element.style.display = "none";
            else
                element.style.display = "block";
        }
    </script>

    <div class="page_wreper">
        <center><div class="heading">
            <span style="color: white; font-size: 28px;">Hello <b><?php echo $user['adminname'] ?> !</b> Welcom to Admin Penal :)</span><a href="logout.php"><button>Logout</button></a>
        </div></center><center>
        <div class="total">
            <div class="t_user">
                <div class="t_user_wreper">
                    <i class="fas fa-user fa-3x" style="margin-top: 15px; color: white; "></i><br>
                    <span style="font-size: 22px; font-family: system-ui; color: white; ">Total Users</span> <br> <span style="font-size: 25px; color: white; "> <?php echo $count_user; ?> </span>
                </div>
            </div>
            <div class="t_post">
                <div class="t_post_wreper">
                    <i class="fas fa-copy fa-3x" style="margin-top: 15px; color: white; "></i><br>
                    <span style="font-size: 22px; font-family: system-ui; color: white; ">Total Posts</span> <br> <span style="font-size: 25px; color: white; "> <?php echo $count_post; ?> </span>
                </div>
            </div>
        </div></center>
        <div class="main" style="margin-top: 50px;">
             <center><div >
               <input type="submit" class="l_user" for="user" name="user" onClick='javascript:show()' value="Remove User">
            </div>             
                <div class="remove" id="remove" style='display:none;'>
                    <iframe src='remove_user.php'></iframe>
                </div>
            </center><center>
            <div >
                <input type="submit" class="l_post" for="Post" onClick='javascript:show2()' name="Post" value="Remove Post">
            </div>            
                <div class="remove" id="remove_post" style='display:none;'>
                    <iframe src='remove_post.php'></iframe>
                </div>            
            </center><center>
            <div >
                <input type="submit" class="l_msg" for="Post" onClick='javascript:show3()' name="Post" value="Remove Message">
            </div>            
                <div class="remove" id="remove_msg" style='display:none;'>
                    <iframe src='remove_msg.php'></iframe>
                </div>           
            </center><center>
            <div >
                <input type="submit" class="l_comment" for="Post" onClick='javascript:show4()' name="Post" value="Remove Comment">
            </div>            
                <div class="remove" id="remove_comment" style='display:none;'>
                    <iframe src='remove_comment.php'></iframe>
                </div>           
            </center>
        </div>
    </div>
</body>
</html>