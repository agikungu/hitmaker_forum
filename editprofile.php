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

//image code
 $image = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];

        $img_tmp = $_FILES['image']['tmp_name'];
        $image=mt_rand(0,100).$image;
         $image=$username.$image;

        //Remove unwanted spaces and characters fro fikenames being uploaded
      //afta ka hash kuna kitu haiko
        $image=preg_replace("#[^a-z0-9.]#","",$image);
      
//$target="upload/profile/".basename($_FILES["image"]["name"]);
$target="upload/profile/".basename($image);

     //   $directory = 'upload/';
     //   $target_file = $directory.$img_name;
//image code
$checkname= "select * from registration WHERE username='$username'";
$query_run = mysqli_query($connection,$checkname);
//check if user exists but allows if session ni yake 
if(mysqli_num_rows($query_run)>0 && $_SESSION[user_name]!= $username)
{
  $_SESSION["errormessage"]="username already exists,please try using another name";
  redirect_to("editprofile.php");
 }elseif (empty($username)) {


  $_SESSION["errormessage"]="username cannot be empty";
  redirect_to("editprofile.php");

   # code...
 }
 else {
  $connectingdb;
  $user_id=$_SESSION["user_name"];
  $userlink=$_SESSION["main_id"];

 $query="SELECT * FROM registration WHERE link='$userlink'";
  $executequery=mysqli_query($connection,$query);
  while($datarows=mysqli_fetch_array($executequery)){
      $jina=$datarows['username'];
      $currentimage=$datarows['image'];
    
    }
 //use the existing image if the user akibadilisha post but image ibakie the same
 if($_FILES["image"]["size"]==0 ){
  $image=$currentimage;     
       }else {
        unlink("upload/profile/$profile");
       }
     
$query="UPDATE registration SET username='$username',image='$image' WHERE link='$link'";
$query2="UPDATE admin_panel SET author='$username' WHERE link='$link'";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
  //resets the session
  $_SESSION["user_name"]=$username;
$execute=mysqli_query($connection,$query);
mysqli_query($connection,$query2);


move_uploaded_file($_FILES["image"]["tmp_name"],$target);

 }
 $execute=mysqli_query($connection,$query);
if($execute){
  $_SESSION["successmessage"]="updated.. your new user name is:  {$_SESSION["user_name"]}  ";
  redirect_to("dashboard.php");
}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("editprofile.php");

}



    }
    
    
    
    
    
    
    ?>
    
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Profile</title>
           
   	<!--cdn include-->
       <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/sidestyle.css">

<style>
    body{
background-image:url(images/bg1.jpg)

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
<h3 style="font-family:stencil">Edit  <?php echo $username; ?>'s profile</h3>  
</center>
<?php 
   $connectingdb;
        $user_id=$_SESSION["user_name"];

       $query="SELECT * FROM registration WHERE username='$user_id'";
        $executequery=mysqli_query($connection,$query);
        while($datarows=mysqli_fetch_array($executequery)){
            $jina=$datarows['username'];
            $currentimage=$datarows['image'];
          
          }
  
  ?> 
<form  action="editprofile.php"  method="post" enctype="multipart/form-data" class="needs-validation" novalidate >
<center>  <img id="uploadpreview" src="upload/profile/<?php $file='C:\xampp\htdocs\weblog with bootrsap 4\upload\profile/';
                if(file_exists($file.$profile)){echo $profile;}else { echo"noimage.jpg"; }?>" 


alt="no-image" class="img-thumbnail rounded-circle"style=" width: 150px;
    height: 150px;
    text-align: center;
    border-radius: 50%;"><br>
    </center>
    <center> <input type="file" value="<?php echo $currentimage; ?>" id="image" name="image" accept=".jpg,.png" onchange="PreviewImage();"/></center>
<br>
<h5 style="font-family:stencil">Your current username is:&nbsp;</h5>
<div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="text" value="<?php echo $jina;?>" id="uname" placeholder="Enter username" autocomplete="off" name="username" required>
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-user"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>

 
           
<center>
<input class="btn btn-success float-right" type="submit" value="Update" name="submit" >

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