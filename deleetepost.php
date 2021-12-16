<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>
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
//$admin="kaggz";
//$image=$_FILES["image"]["name"];

//$target="upload/".basename($_FILES["image"]["name"]);
 $searchqueryparameter=$_GET['delete'];
       $connectingdb;
       $query="SELECT * FROM admin_panel WHERE id='$searchqueryparameter'";
        $executequery=mysqli_query($connection,$query);
        while($datarows=mysqli_fetch_array($executequery)){
             $imageupdate=$datarows['image'];
           
        }


    //error is from here..inakataa ku update data kwa database..alafu inasema error//
    //
global $connectingdb;
$deletefromurl=$_GET['delete'];
//customm chini
//custom juu
//	$result = mysqli_query($mysqli, "UPDATE users SET name='$name',email='$email',mobile='$mobile' WHERE id=$id");

//$query=mysqli_query($connectingdb,"UPDATE admin_panel SET datetime='$datetime',title='$title',category='$category',author,='$admin',image='$image',post='$post' 
//WHERE id=$editfromurl");
$query="DELETE FROM admin_panel WHERE id='$deletefromurl'";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($newconnection,$query);


if($execute){
  
  $_SESSION["successmessage"]="Post Deleted succesfully";
unlink("upload/$imageupdate");

  redirect_to("dashboard.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("dashboard.php");

}


  # code...






  
}#isset condition




?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new post</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/adminstyles.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<style>

.fieldinfo{
color: rgb(251,174,44);
font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;



}


</style>


</head>
<body>
<nav class="navbar"style="background-color:#1ab394">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            <div class="navbar-header">
      <a class="navbar-brand" href="#">
          <img src="images/logo.jpg"  class=" rounded-circle z-depth-0"
            alt="avatar image" height="50" style="margin-top:-15px">
    </a>
    </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"> <a class="nav-link" href="blog.php?page=<?php echo 1; ?>"  >Blog</a></li>
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form action="blog.php" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
        </div>
        <button class="btn btn-default" name="searchbutton">Go</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
   
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-th-large"></span></a>
          <ul class="dropdown-menu">
             </form>
          <?php 
           if (isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
             echo '
             <li>
          <a href="logout.php" >
         &nbsp;&nbsp; <span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout
         </li></a>
          <li>
          <a href="dashboard.php" >
         &nbsp;&nbsp; <span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;Dashboard
         </li></a>
         
        
             
             ';
     
    }
    else {
      
      
echo '  
  
      
          <li>
          <a href="register.php" >
         &nbsp;&nbsp; <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Register
         </li></a>
         ';

    } 
          ?>
           
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--old nav begins hehre--> 

<!--ssaSa-->


<!--ssaSa-->

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-2"style="background-color: #1ab394;border-radius:30px;margin-right:10px">
    <h1>ALEKi</h1>
    <ul id="side_menu" class="nav nav-pills nav-link nav-stacked" >
    <li  ><a href="dashboard.php">
   
     <span class="glyphicon glyphicon-th"></span>
      Dashboard</a></li>
    <li class="active" ><a href="addnewpost.php">
    <span class="glyphicon glyphicon-list-alt"></span>&nbsp;  Add new post</a></li>
    <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) { ?>

<li ><a href="categories.php" class="dashlink">
<span class="glyphicon glyphicon-tags"></span>&nbsp; Categories</a></li>
<li ><a href="admins.php" class="dashlink">
<span class="glyphicon glyphicon-user"></span>&nbsp;   Manage Admins</a></li>
        <?php } ?>

 
    <li ><a href="dashboard.php">
    <span class="glyphicon glyphicon-comment"></span>&nbsp;  Comments</a></li>
    <li ><a href="dashboard.php">
    <span class="glyphicon glyphicon-equalizer"></span> &nbsp; Live Blog</a></li>
    <li ><a href="logout.php">
    <span class="glyphicon glyphicon-log-out"></span> &nbsp; Logout</a></li>

    
    
    </ul>
    
    
    </div><!--Ending of side area-->
    <div class="col-sm-10" style="background-color: #1ab394;border-radius:30px;width:80%;margin:0 auto">
    <center>
<h1 style="font-family:stencil">Delete  post</h1>  
</center>
<br>
<?php  echo errormessage(); 
         echo successmessage(); 


?>

   <div>
       <?php 
       $searchqueryparameter=$_GET['delete'];
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
<form action="deletepost.php?delete=<?php echo $searchqueryparameter; ?>" method="post" enctype="multipart/form-data">
<fieldset>

<div class="form-group">
<label for="title"> <span class="fieldinfo"> Title:</span></label>
<input disabled  value="<?php echo $titleupdate; ?>"  name="title" class="form-control" type="text" id="title" placeholder="title">
</div>
<div class="form-group">
   
<label for="categoryselect"> <span class="fieldinfo">Category:</span></label><br>
<span class="field-info">Existing Category Is: </span>
  <span style="background-color:yellow; font-family:cooper; padding:8px;" > <?php echo $categoryupdate; ?></span> 
    <br><br>

<select disabled class="form-control" name="category" id="categoryselect">


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
<span class="field-info">Existing Image Is:&nbsp; &nbsp; </span>
   <img class="img-thumbnail" src="upload/<?php echo $imageupdate; ?>" width=170px  height=70px>
    <br>
<label for="imageselect"> <span class="fieldinfo">Select image:</span></label>
<input disabled  type="file" name="image" class="form-controll"id="imageselect" >   
</div>

<div class="form-group">
<label for="postarea"> <span class="fieldinfo">Post:</span></label>
<textarea disabled class="form-control" name="post" id="postarea">
<?php echo $postupdate; ?>

</textarea>

<br>
<input class="btn btn-danger btn-lg pull-right" type="submit" value="delete Post" name="update">
<a href="dashboard.php" >
<input class="btn btn-info btn-lg" type="button" value="Back" >
</a>
<br>
</fieldset>


</form>
</div>


   
    
    </div><!--Ending of White main area-->
    
    </div><!--Ending of row-->
    </div><!--Ending of container fluid-->
    
     <div id="footer">
<hr>
<p>
  Theme by  | Kaggz | &copy; 2019-2030  --- All right reserved.
</p>



     </div> 
    
     <div style="height: 10px; background: #27aaf1;"></div> 
    
    
    
    
    
    
     
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/popper.min.js"></script>
<!--js script for drop downs-->
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>