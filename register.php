<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>

<?php
if (isset($_POST["submit"])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
  $username=mysqli_real_escape_string( $connection, $_POST["username"]);
  $password=mysqli_real_escape_string( $connection, $_POST["password"]);
  $confirmpassword=mysqli_real_escape_string( $connection, $_POST["confirmpassword"]);

  date_default_timezone_set("Africa/Nairobi");
$currenttime=time();
//$datetime=strftime("%Y-%m-%d %H: %M: %S",$currenttime);
$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);
//$admin=$_SESSION["user_name"];
$admin=mysqli_real_escape_string( $connection, $_POST["username"]);
//hii ina generate a random number
$link=uniqid(rand(),true);
//image code
 $image = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];

        $img_tmp = $_FILES['image']['tmp_name'];
        $image=mt_rand(0,100).$image;
        $image=$admin.$image;
        //Remove unwanted spaces and characters fro fikenames being uploaded
      //afta ka hash kuna kitu haiko
        $image=preg_replace("#[^a-z0-9.]#","",$image);
      
//$target="upload/profile/".basename($_FILES["image"]["name"]);
$target="upload/profile/".basename($image);

     //   $directory = 'upload/';
     //   $target_file = $directory.$img_name;
//image code
//check if input fields ziko empty
if (empty($username)||empty($password)||empty($confirmpassword)) {

  $_SESSION["errormessage"]=" All fields must be filled";

redirect_to("register.php");

 //check if pasword  is less than 4 characters
}elseif (strlen($password)<4) {

  $_SESSION["errormessage"]="Atleast 4 characters are required for the password";

redirect_to("register.php");

 //check if passwords match
}elseif ($password!=$confirmpassword) {

  $_SESSION["errormessage"]="Password/confirm password does not match";

redirect_to("register.php");

// check if profile image exists
}  else if (file_exists($target)) {
  $_SESSION["errormessage"]="The image already exists Please try another image";
//check if image file is greater than 1mb
   }  else if ($img_size>1000000) { 
  $_SESSION["errormessage"]="Image size cannot be larger than 1mb";

      }
    elseif ($password==$confirmpassword) {
       $checkname= "select * from registration WHERE username='$username'";
  $query_run = mysqli_query($connection,$checkname);
  //check if user exists
  if(mysqli_num_rows($query_run)>0)
  {
    $_SESSION["errormessage"]="username already exists,please try using another name";
   }
   else {
    
//insert user into database
global $connectingdb;
$query="INSERT INTO registration(datetime,username,password,addedby,image,link) VALUES ('$datetime','$username','$password','$admin','$image','$link')";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);
move_uploaded_file($_FILES["image"]["tmp_name"],$target);
if($execute){
  $_SESSION["successmessage"]="Registration succesfull You can now login";

redirect_to("login.php");

}else{
  $_SESSION["errormessage"]="Something went wrong";

  redirect_to("register.php");

}



   }
 

      }
 else 
 {

   


  # code...
}





  
}#isset condition




?>



<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Registration Page</title>
          	<!--cdn include-->
  <?php include("include/cdns.php") ;  ?>

<!--cdn include-->   
          
<style>
body {
    /* */
    background-image: url("images/bg1.jpg");
    background-size: cover;
    background-repeat: no-repeat;   
   # background-color:#576574
}

.about img {
	display: block;
	width: 100px;
	height: 100px;
	line-height: 100px;
	margin:auto;
	border-radius:50%;  
	font-size: 40px;
	opacity: 0.7;
	webkit-transition:all .5s ease;
 	moz-transition:all .5s ease;
 	os-transition:all .5s ease;
 	transition:all .5s ease;

}

.about-item:hover img{
	opacity: 1;	
	font-size: 42px;
	-webkit-transform: scale(1.1,1.1) rotate(360deg) ;
	-moz-transform: scale(1.1,1.1) rotate(360deg) ;
	-o-transform: scale(1.1,1.1) rotate(360deg) ;
	transform: scale(1.1,1.1) rotate(360deg) ;
}

 
    
</style>
   <!--javascript preview image-->
     <script type="text/javascript">
        
        function PreviewImage() {

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image").files[0]);
    
    oFReader.onload = function(oFRevent) {
        document.getElementById("uploadpreview").src=oFRevent.target.result;

    };
    
};
    </script>   
   <!--javascript preview image-->     
</head>
<body >
   	<!--cdn include-->
  <?php include("include/navbar.php") ;  ?>

<!--cdn include-->

    <br><br>
   
 
<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 about"style=" background-color:#1779db38; border-radius:30px">
        <br>
<div class="container-fluid " style="height:70px; background:#27aae1;font-family:stencil; border-radius:30px;padding:10px">
    <center>
  <h2>Join us</h2></center>
    </div><br>
        <br>  
        <center>
       
    <?php  echo errormessage(); 
         echo successmessage(); 
         ?>

      
</center>
<form action="register.php" method="post" enctype="multipart/form-data" class="needs-validation about-item" novalidate >
<center>  <img id="uploadpreview" src="images/rim.png" alt="no-image" class="rounded-circle"style=" width: 150px;
    height: 150px;
    text-align: center;
    border-radius: 50%;"><br>
    </center>
    <center> <input    type="file" id="image" name="image" accept=".jpg,.png" onchange="PreviewImage();"/></center>
<br>
<div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="text" id="uname" placeholder="Enter username" autocomplete="off" name="username" required>
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-user"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>

       <div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="password" id="pwd" placeholder="Enter password" autocomplete="off" name="password" required>
                <span class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </span>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br> 
            
            
            <div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="password" id="pwd" placeholder="Confirm password" autocomplete="off" name="confirmpassword" required>
                <span class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </span>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>
           
<input class="btn btn-success btn-block" type="submit" value="Register" name="submit" >
<a href="login.php" >
<br>
    <input class="btn btn-primary btn-block" type="button" value="Login" ><br>
    </a>

  </form>
</div>
                        </div>
                        </div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</div>
</body>
</html>