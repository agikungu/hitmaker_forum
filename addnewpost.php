<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>
<?php  require_once("include/customfunctions.php"); ?>

<?php   
    if ($_SESSION['loggedin']) {
        # code...
    }
    else {
$_SESSION["errormessage"]="Login Required ";
       redirect_to("login.php");
    }  ?>
<?php
if (isset($_POST["submit"])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
  $title=mysqli_real_escape_string( $connection, $_POST["title"]);
  $category=mysqli_real_escape_string( $connection, $_POST["category"]);
  $post=mysqli_real_escape_string( $connection, $_POST["post"]);
date_default_timezone_set("Africa/Nairobi");
$currenttime=time();
//$datetime=strftime("%Y-%m-%d %H: %M: %S",$currenttime);
//$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);
$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);


$admin=$_SESSION["user_name"];
//check if there is an image chosen
$valimage=$_FILES["image"]["name"];

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
$target="upload/".basename($image);

//   $directory = 'upload/';
//   $target_file = $directory.$img_name;
//image code
//////////////////////////
    $viewquery="SELECT * FROM registration WHERE username='$admin';";
    $execute=mysqli_query($connection,$viewquery);
  
    while($datarows=mysqli_fetch_array($execute)){
     
           $link=$datarows["link"];


    }

//$target="upload/".basename($link);
//$target="upload/".basename($_FILES["image"]["name"]);


if (empty($title)) {

  $_SESSION["errormessage"]="Title cannot be empty";

redirect_to("addnewpost.php");

 
}elseif (strlen($title)<2) {

  $_SESSION["errormessage"]="title should be at least two characters";

  redirect_to("addnewpost.php");

 
}elseif (empty($post)) {
  $_SESSION["errormessage"]="post cannot be empty";

  redirect_to("addnewpost.php");

} elseif (empty($valimage)) {
  $_SESSION["errormessage"]="Please chose an image";

  redirect_to("addnewpost.php");

} 


else {
global $connectingdb;
$query="INSERT INTO admin_panel(datetime,title,category,author,image,post,link) VALUES ('$datetime','$title','$category','$admin','$image','$post','$link')";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);
move_uploaded_file($_FILES["image"]["tmp_name"],$target);

if($execute){
  $_SESSION["successmessage"]="Post added succesfully";

  redirect_to("dashboard.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again $datetime";
  //January-01-1970 03: 00: 00
  //June-04-2021 11: 17: 25
  //June-04-2021 11: 21: 09
  //June-04-2021 11: 25: 40	

  redirect_to("addnewpost.php");

}


  # code...
}





  
}#isset condition



?>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Add post</title>
   
   	<!--cdn include-->
       <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/sidestyle.css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
 


<style>
body {
    /* */
    background-image: url("images/bg1.jpg");
    background-size: cover;
    background-repeat: no-repeat; 
   
   # background-color:#576574
}

 .dropdown>.dropdown-menu {
  top: 200%;
  transition: 0.3s all ease-in-out;
}
.dropdown:hover>.dropdown-menu {
  display: block;
  top: 100%;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
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
   
<!--  -->
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
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
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


        <div class="col col-sm-6 col-md-10 col-lg-10 col-xl-10 "style="  margin: 0 auto;background-color:#1779db38; border-radius:30px">
        <center>
<h1 style="font-family:stencil">Create your new post</h1>  
</center>

      <br>
<?php  echo errormessage(); 
         echo successmessage(); 


?>

<form action="addnewpost.php" method="post" enctype="multipart/form-data">
<fieldset>  
   <!-- Upload image input-->
<center>  <img id="uploadpreview" src="images/noimage.jpg" alt="no-image" class="img-thumbnail "style=" width: 250px;
    height: 150px;
    text-align: center;">
    <br>
    <br>
    </center>
    <center>

     <input  class="btn btn-info m-0 rounded-pill" required  type="file" id="image" name="image" accept=".jpg,.png" onchange="PreviewImage();"/></center>
  

<br>



<br>
<div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="text" id="uname" placeholder="Post Title" autocomplete="off" name="title" required>
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-user"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>
<div class="form-group">
<label for="categoryselect"> <span class="fieldinfo">Category:</span></label>
<select class="form-control" name="category" id="categoryselect">


<?php
   global $connectingdb;
   //hapa ORDER BY haifai kuwa imeshikana kama ya jazeb
   $viewquery="SELECT * FROM category ORDER BY datetime desc";
   //hapa pia ukitumia old mysql query bila parameters mbili itakataa
   $execute=mysqli_query($connection,$viewquery);
 


   while($datarows=mysqli_fetch_array($execute)){
      $id=$datarows["id"];
     $categoryname=$datarows["name"];
    
    
   
   
   ?>
   <option >  <?php  echo $categoryname;   ?>   </option>
   <?php }  ?>
   



</select>
</div>

<div class="form-group">
<label for="postarea"> <span class="fieldinfo">Post:</span></label>
<textarea class="form-control" name="post" id="summernote"></textarea>
<br>


<input class="btn btn-success btn-block" type="submit" value="Add New Post" name="submit">
<br>
</fieldset>
<script>
      $('#summernote').summernote({
        placeholder: 'Hello....... type your post here',
        tabsize: 2,
        height: 100
      });
    </script>


    


</form>

      </div>
    
    </div><!--Ending of transparent form main area-->
    
    </div><!--Ending of row-->
    
  
       <!--bootstrap 4 online js cdns-->


     
        
   <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
-->
   <!--bootstrap 4 online js cdns-->
  <!--
      <script src="bootstrap-4.4.1-dist/js/jquery.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
       -->

         <!--sidebar js -->
      <script src="bootstrap-4.4.1-dist/js/main.js"></script>
       <!--sidebar js -->




  <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>



</body>
</html>