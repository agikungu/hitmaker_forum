<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php"); ?>
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
if (isset($_POST['update'])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
  $title=mysqli_real_escape_string( $connection, $_POST["title"]);
  $category=mysqli_real_escape_string( $connection, $_POST["category"]);
  $post=mysqli_real_escape_string( $connection, $_POST["post"]);
date_default_timezone_set("Africa/Nairobi");
$currenttime=time();
//$datetime=strftime("%Y-%m-%d %H: %M: %S",$currenttime);
$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);
$admin=$_SESSION["user_name"];
$image=$_FILES["image"]["name"];

$target="upload/".basename($_FILES["image"]["name"]);


if (empty($title)) {

  $_SESSION["errormessage"]="Title cannot be empty Try editing again";

redirect_to("dashboard.php");

 
}elseif (strlen($title)<2) {

  $_SESSION["errormessage"]="title should be at least two characters";

  redirect_to("dashboard.php");

 
} else {

    //error is from here..inakataa ku update data kwa database..alafu inasema error//
    //
global $connectingdb;
$editfromurl=$_GET['edit'];
//customm chini
//custom juu
//	$result = mysqli_query($mysqli, "UPDATE users SET name='$name',email='$email',mobile='$mobile' WHERE id=$id");

//$query=mysqli_query($connectingdb,"UPDATE admin_panel SET datetime='$datetime',title='$title',category='$category',author,='$admin',image='$image',post='$post' 
//WHERE id=$editfromurl");
$searchqueryparameter=$_GET['edit'];
$connectingdb;
$query2="SELECT * FROM admin_panel WHERE id='$searchqueryparameter'";
 $executequery=mysqli_query($connection,$query2);
 while($datarows=mysqli_fetch_array($executequery)){
     $titleupdate=$datarows['title'];
     $categoryupdate=$datarows['category'];
     $imageupdate=$datarows['image'];
     $postupdate=$datarows['post'];
     $owner=$datarows['author'];



 }
 //use the existing image if the user akibadilisha post but image ibakie the same
     if($_FILES["image"]["size"]==0 ){
$image=$imageupdate;     
     }
   
$query="UPDATE admin_panel SET datetime=now(),title='$title',
category='$category',author='$owner',image='$image',post='$post' 
WHERE id='$editfromurl'";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);
move_uploaded_file($_FILES["image"]["tmp_name"],$target);

if($execute){
  $_SESSION["successmessage"]="Post updated succesfully";

  redirect_to("dashboard.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("dashboard.php");

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
   <title>Edit post</title>
   	<!--cdn include-->
       <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">
        <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/sidestyle.css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
 

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


        <!-- Page Content  -->
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
<h1 style="font-family:stencil">Edit your post</h1>  
</center>

      <br>
<?php  echo errormessage(); 
         echo successmessage(); 


?>
   <?php 
       $searchqueryparameter=$_GET['edit'];
       $connectingdb;
       $query="SELECT * FROM admin_panel WHERE id='$searchqueryparameter'";
        $executequery=mysqli_query($connection,$query);
        while($datarows=mysqli_fetch_array($executequery)){
            $titleupdate=$datarows['title'];
            $categoryupdate=$datarows['category'];
            $imageupdate=$datarows['image'];
            $postupdate=$datarows['post'];

        }
       
       ?>
<form action="editpost.php?edit=<?php echo $searchqueryparameter; ?>" method="post" enctype="multipart/form-data">
<fieldset>  
   <!-- Upload image input-->
<center> 
<h5 style="font-family:stencil">Your existing image is:&nbsp;</h5>  
 <img id="uploadpreview" src="upload/<?php echo $imageupdate; ?>" alt="no-image" class="img-thumbnail "style=" width: 250px;
    height: 150px;
    text-align: center;">
    <br>
    <br>
 
    <div class="container-fluid">

     <input  class="btn btn-info m-0 rounded-pill "type="file" id="image" name="image" accept=".jpg,.png" onchange="PreviewImage();" style="max-width:50%"/>
     </div>
     </center>

<br>



<br><h5 style="font-family:stencil">Your existing title is:&nbsp;</h5> </span>

<div class="input-group">

                <input class="form-control py-2 border-right-0 border" type="text" id="uname" placeholder="Post Title" autocomplete="off" name="title" value="<?php echo $titleupdate; ?>">
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-user"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>  <br>

<label for="categoryselect"> <span class="fieldinfo"><h5 style="font-family:stencil">Existing category is:&nbsp;</h5> </span></label>
<div class="form-group">

<select class="form-control" name="category" id="categoryselect">
<option selected>  <?php echo $categoryupdate; ?>  </option>

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
   <option > <?php  echo $categoryname;   ?>   </option>
   <?php }  ?>
   



</select>
</div>
<br>
<div class="form-group">
<label for="postarea"> <span class="fieldinfo"><h5 style="font-family:stencil">Your post is:&nbsp;</h5> </span></label>
<textarea class="form-control" name="post" id="summernote">
<?php echo $postupdate; ?>
</textarea>
<br>
<center>
<button type="submit" class="btn btn-info float-right" name="update" style="max-width:40%"><i class="fas fa-edit"></i>&nbsp;&nbsp;Update</button>

<a href="dashboard.php" >

<button type="button" class="btn btn-primary float-left"  style="max-width:40%"><i class="fas fa-backward"></i>&nbsp;Back</button>
</a>
</center>
<br>
<br><br>
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
    
  
      



  <!-- 
   
      <script src="bootstrap-4.4.1-dist/js/jquery.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
      <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>
    -->

  <script src="bootstrap-4.4.1-dist/js/main.js"></script>

</body>
</html>