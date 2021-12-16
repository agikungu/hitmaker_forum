<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php");  ?>
<?php  require_once("include/functions.php"); ?>
<?php  require_once("include/customfunctions.php"); ?>

<?php   
    if ($_SESSION["user_id"]) {
        # code...
    }
    else {
$_SESSION["errormessage"]="Login Required ";
       redirect_to("login.php");
    }  ?>

    
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

$adby=$_SESSION[user_name];
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

redirect_to("addadmin.php");

 //check if pasword  is less than 4 characters
}elseif (strlen($password)<4) {

  $_SESSION["errormessage"]="Atleast 4 characters are required for the password";

  redirect_to("addadmin.php");

 //check if passwords match
}elseif ($password!=$confirmpassword) {

  $_SESSION["errormessage"]="Password/confirm password does not match";

  redirect_to("addadmin.php");

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
$query="INSERT INTO registration(datetime,username,password,addedby,image,link) VALUES ('$datetime','$username','$password','$adby','$image','$link')";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);
move_uploaded_file($_FILES["image"]["tmp_name"],$target);
if($execute){
  $_SESSION["successmessage"]="User added succesfull";

  redirect_to("addadmin.php");

}else{
  $_SESSION["errormessage"]="Something went wrong";

  redirect_to("addadmin.php");

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
   <title>Add user</title>
          
   	<!--cdn include-->
       <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/sidestyle.css">

<style>
 body {
    /* */
    background-image: url("images/bg1.jpg");
    background-size: cover;
    background-repeat: no-repeat; 
   
   # background-color:#576574
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
   
<!--
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
    <img src="images/logo.jpg" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
  <li class="nav-item active">
						<a class="nav-link" href="#"><i class="fa fa-blog"></i> blog<span class="sr-only">(current)</span></a>
					</li>

                    	<li class="nav-item active">
						<a class="nav-link" href="#"><i class="fa fa-envelope"></i> Contact </a>
					</li>
  
  </ul>
  <ul class="navbar-nav ml-auto">
				
        <li class="nav-item dropdown" style="padding: 15px; padding-bottom: 10px;">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> &nbsp;Profile  &nbsp;&nbsp; </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
              </div>
      </li>
    </ul>
			</div>
      </nav>
    -->
<!-- SideNav slide-out button -->

	<div class="wrapper d-flex align-items-stretch">
	<!--sidenav include-->
<?php include("include/sidebar.php") ;  ?>

<!--sidenav include-->
      <div id="content">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto bg-in">
                  
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-address-book"></i>&nbsp;About</a>
                </li>
         
              
                &nbsp;                     <!-- Dropdown -->
                    <li class="nav-item dropdown ml-auto">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;<i class="fas fa-user-circle" ></i>&nbsp; &nbsp; </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <?php 
          if (isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
             echo '
             <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Log out</a>
             <a class="dropdown-item" href="dashboard.php"><i class="fas fa-th"></i>&nbsp;dashboard</a>


             ';
            }
             
             else {
            
                echo'
            <a class="dropdown-item" href="register.php"><i class="fas fa-user-alt"></i>&nbsp;Register</a>
            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-in-alt"></i>&nbsp;Log in</a>

';
        }
        
        ?>
                  </div>
            </li>
              </ul>
            </div>
          </div>
        </nav>
<!--end of nav-->

<div class="col-lg-12 my-auto">
    </div>


        <div class="col col-sm-10 col-md-10 col-lg-10 col-xl-10 "style="  margin: 0 auto;background-color:#1779db38; border-radius:30px">

    
    <div>
      <br>
<?php  echo errormessage(); 
         echo successmessage(); 


?>

      </div>
      <center>
<h1 style="font-family:stencil">Add new User</h1>  
</center>

<form action="addadmin.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate >
<center>  <img id="uploadpreview" src="images/noimage.jpg" alt="no-image" class="img-thumbnail rounded-circle"style=" width: 150px;
    height: 150px;
    text-align: center;
    border-radius: 50%;"><br>
    </center>
    <center> <input type="file" id="image" name="image" accept=".jpg,.png" onchange="PreviewImage();"/></center>
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
           
<center>
<input class="btn btn-success float-right" type="submit" value="Register" name="submit" >

<a href="dashboard.php" >

<button type="button" class="btn btn-primary float-left"  style="max-width:40%"><i class="fas fa-backward"></i>&nbsp;Back</button>
</a><br><br>
</center>

  </form>

    </div><!--Ending of White main area-->
    
    </div><!--Ending of row-->
    
    </div><!--Ending of container fluid-->
    
    
    </div>
       <!--bootstrap 4 online js cdns-->


     
        
   <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
-->
   <!--bootstrap 4 online js cdns-->
  
      <script src="bootstrap-4.4.1-dist/js/jquery.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/main.js"></script>





  <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>



</body>
</html>