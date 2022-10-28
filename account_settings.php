<!-- Account setting.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php include 'header.php'; 
      include ;
      include 'classes/Post.php';
     $msg = "";

    $user_detail_query = mysqli_query($con,"select * from users where username='$userLoggedIn'");
    $user_array = mysqli_fetch_array($user_detail_query);

    if(isset($_POST['submit_cover_pic'])){
        $uploadOk = 1;
        $imageName = $_FILES['cover_pic']['name'];
        $errorMessage = "";
        
        if($imageName != ""){
            $targetDir = "assets/images/cover_pics/";
            $imageName = $targetDir . basename($imageName);
            $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
            
            if($uploadOk){
                if(move_uploaded_file($_FILES['cover_pic']['tmp_name'], $imageName)){
                    //image Upload Okey
                    $errorMessage = "uploaded";
                }
                else{
                    $uploadOk = 0;
                    $errorMessage = "fail to upload";
                }
            }
        }
        
        if($uploadOk){
            $update_covet_pic = mysqli_query($con, "update users set cover_pic='$imageName' where username='$userLoggedIn'") or die(mysqli_error($con));
            // header("Location: account_settings.php");
        }
        else{
            echo $errorMessage;
        }


    }

    if(isset($_POST['submit_profile_pic'])){
        $uploadOk = 1;
        $imageName = $_FILES['profile_pic']['name'];
        $errorMessage = "";
        
        if($imageName != ""){
            $targetDir = "assets/images/profile_pics/";
            $imageName = $targetDir . basename($imageName);
            $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
            
            if($uploadOk){
                if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $imageName)){
                    //image Upload Okey
                    $errorMessage = "uploaded";
                }
                else{
                    $uploadOk = 0;
                    $errorMessage = "fail to upload";
                }
            }
        }
        
        if($uploadOk){
            $update_covet_pic = mysqli_query($con, "update users set profile_pic='$imageName' where username='$userLoggedIn'") or die(mysqli_error($con));
            // header("Location: account_settings.php");
        }
        else{
            echo $errorMessage;
        }


    }

    $Fname = "";
    $Lname = "";
    $DOB = "";
    $h_town = "";
   
    $error_array = array();

    if(isset($_POST['submit_Fname'])){
        $Fname = $_POST['Fname'];
        $Fname = strip_tags($Fname); //remove thigs like <,>...etc tages
        $Fname = mysqli_real_escape_string($con, $Fname); //egnore the ' in post boddy
        $query = mysqli_query($con, "update users set first_name='$Fname' where username='$userLoggedIn'") or die("cannot update".mysqli_error($con));
        if($query)
            array_push($error_array, "First name Updated :)");       
        else 
            array_push($error_array, "Fail to Updated First name :(");
        // header("Location: account_settings.php");
    }

    if(isset($_POST['submit_Lname'])){
        $Lname = $_POST['Lname'];
        $Lname = strip_tags($Lname); //remove thigs like <,>...etc tages
        $Lname = mysqli_real_escape_string($con, $Lname); //egnore the ' in post boddy
        $query = mysqli_query($con, "update users set last_name='$Lname' where username='$userLoggedIn'") or die("cannot update".mysqli_error($con));
        if($query)
            array_push($error_array, "last name Updated :)");       
        else 
            array_push($error_array, "Fail to Updated last name :(");
        // header("Location: account_settings.php");
    }

    if(isset($_POST['submit_date'])){
        $DOB = $_POST['DOB'];
        $DOB = strip_tags($DOB); //remove thigs like <,>...etc tages
        $DOB = mysqli_real_escape_string($con, $DOB); //egnore the ' in post boddy
        $query = mysqli_query($con, "update users set dob='$DOB' where username='$userLoggedIn'") or die("cannot update".mysqli_error($con));
        if($query)
            array_push($error_array, "Birth Date Updated :)");       
        else 
            array_push($error_array, "Fail to Updated Birth Date :(");   
        // header("Location: account_settings.php");
    }

    if(isset($_POST['submit_htown'])){
        $h_town = $_POST['h_town'];
        $h_town = strip_tags($h_town); //remove thigs like <,>...etc tages
        $h_town = mysqli_real_escape_string($con, $h_town); //egnore the ' in post boddy
        $query = mysqli_query($con, "update users set hometown='$h_town' where username='$userLoggedIn'") or die("cannot update".mysqli_error($con));
        if($query)
            array_push($error_array, "Hometown Updated :)");       
        else 
            array_push($error_array, "Fail to Updated Hometown :(");   
        // header("Location: account_settings.php");
    }

?>

<style>
    .setting_main{
        width: 700px;
        height: auto;
        background: white;
        margin-top: 95px;
        margin-bottom: 150px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 5px;
        padding-top: 25px;
        padding-bottom: 30px;
        padding-left: 20px;
    }
    img{
        height: 90%;
        width: 90%;
    }

    .imgs{
        height: 100px;
        width: 40%;
    }

    .setting_span{
        margin-left: 116px;
        position: absolute;
    }

    hr{
        width: 97%;
        margin-left: 0px;
    }

    center{
        font-size: 30px;
        margin-bottom: 20px;
    }

    input[type="text"]{
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #7b7b7b;
        background: #ffffff;
        border-radius: 5px;
        width: 170px;
    }

    input[type="submit"]{
        padding: 5px 12px 5px 12px;
        height: 30px;
        background: #0090ff;
        color: white;
        border: none;
        border-radius: 4px;
        margin-top: auto;
        margin-bottom: auto;
    }

    input[type="date"]{
        width: 170px;
        border-radius: 5px;
        margin-right: 10px;
        padding: 5px;
        height: 15px;
        border: 1px solid #7b7b7b;
    }
    
</style>

    <div class="setting_main">
        <center><b> Settings </b></center> <hr style="margin-left: auto; width: 70%; margin-bottom: 20px;">
        <div class="main_wreper">
            <div >
                <table>
                <form action="account_settings.php" method="post"  enctype="multipart/form-data">
                    <tr class="r1">
                        <td class="imgs"> <img src='<?php echo $user_array['cover_pic']; ?>' height="50px"> </td>
                        <td class="covet_img"> <span><h4>Chang Cover Pic :<h4> <input type="file" name="cover_pic" id="cover"> <input type="submit" name="submit_cover_pic" value="Sublit"> <input type="submit" style="background: darkorange;" value="Cancel"></span> </td>
                    </tr>
                    <tr><td><hr style="width: 240%;"></td></tr>
                    <tr class="r2">
                        <td class="imgs2" >  <img src='<?php echo $user_array['profile_pic']; ?>' style="height: 100px; width: 100px;">  </td>
                        <td >  <span style="margin-top: 0px; margin-left: 182px;"> <h4>Chang Profile Pic :<h4> <input type="file" name="profile_pic" id="profile"><input type="submit" name="submit_profile_pic" value="Sublit"> <input type="submit" style="background: darkorange;" value="Cancel"></span>  </td>
                    </tr>
                    <tr><td><hr style="width: 240%;"></td></tr>
                    <tr class="r4">
                        <td> <span> Edit Your Friest Name :  </span> </td>
                        <td> <input type="text" name="Fname" id="Fname"> <input type="submit" name="submit_Fname" value="Edit"> <input type="submit" style="background: darkorange;" value="Cancel">  <?php if (in_array("Fail to update First name" , $error_array)) echo "<br>Fail to update First name"; elseif (in_array("First name Updated :)" , $error_array)) { echo "<br>First name update :)"; } 
                    ?> </td>
                    </tr>
                    <tr><td><hr style="width: 240%;"></td></tr>
                    <tr class="r5">
                        <td> <span> Edit Your Last Name :  </span> </td>
                        <td> <input type="text" name="Lname" id="Lname"> <input type="submit" name="submit_Lname" value="Edit"> <input type="submit" style="background: darkorange;" value="Cancel"> <?php if (in_array("Fail to update last Name" , $error_array)) echo "<br>Fail to update last Name"; elseif (in_array("Last name Updated :)" , $error_array)) { echo "<br>Last name Updated :)"; }  ?> </td>
                    </tr>
                    <tr><td><hr style="width: 240%;"></td></tr>
                    <tr class="r6">
                        <td> <span> Edit Your Hometown :  </span> </td>
                        <td> <input type="text" name="h_town" id="h_town"> <input type="submit" name="submit_htown" value="Edit"> <input type="submit" style="background: darkorange;" value="Cancel"> <?php if (in_array("Fail to update Hometown" , $error_array)) echo "<br>Fail to update Hometown"; elseif (in_array("Hometown Updated :)" , $error_array)) { echo "<br>Hometown Updated :)"; } ?> </td>
                    </tr>
                    <tr><td><hr style="width: 240%;"></td></tr>
                    <tr class="r7">
                        <td> <span>  Edit Your Birth Date :  </span> </td>
                        <td> <input type="date" name="DOB" id="DOB"> <input type="submit" name="submit_date" value="Edit"> <input type="submit" style="background: darkorange;" value="Cancel"> <?php if (in_array("Fail to update Birth date" , $error_array)) echo "<br>Fail to update Birth date"; elseif (in_array("Birth Date Updated :)" , $error_array)) { echo "<br>Birth Date Updated :)"; } ?> </td>
                    </tr>
                </form>
                </table>
            </div>
        </div> 
    </div>