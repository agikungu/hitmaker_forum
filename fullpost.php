<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>



<?php
if (isset($_POST["submit"])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
  $name=mysqli_real_escape_string( $connection, $_POST["name"]);
  $comment=mysqli_real_escape_string( $connection, $_POST["comment"]);
date_default_timezone_set("Africa/Nairobi");
$currenttime=time();
//$datetime=strftime("%Y-%m-%d %H: %M: %S",$currenttime);
$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);




if (empty($name)  || empty($comment) ) {

  $_SESSION["errormessage"]="All Fields are Required ";


   
}elseif (strlen($comment)>200) {

  $_SESSION["errormessage"]="Only 200 characters are allowed in the comment section";



 
} else {
global $connectingdb;
$postid=$_GET["id"];
$postidfromurl=$_GET['id'];

$viewquery="SELECT * FROM admin_panel WHERE id='$postidfromurl'";}
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
$pname=$datarows["title"];
$userid=$datarows["link"];


 
$query="INSERT into comments(datetime,name,comment,postname,approvedby,status,admin_panel_id,author)
VALUES('$datetime','$name','$comment','$pname','Pending','OFF','$postidfromurl','$userid')";

//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);

if($execute){
  $_SESSION["successmessage"]="Comment added succesfully";

  redirect_to("fullpost.php?id={$postid} ");

}else{
  $_SESSION["errormessage"]="Something went wrong try again $datetime";

redirect_to("fullpost.php?id={$postid} ");
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
   <title>Fullpost</title>
              	<!--cdn include-->
  <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">


<style>
    body{

    }

</style>
               
</head>
<body >
                 	<!--cdn include-->
  <?php include("include/navbar.php") ;  ?>
<!--cdn include-->

     
               <!--body content-->
              <div class="container">
            <div class="row">
 <!--Main blog Area-->
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 ">
           
            <?php  echo errormessage(); 
         echo successmessage(); 


?>
<?php 
global $connectingdb;
if (isset($_GET["searchbutton"])) 
{
$search=$_GET["search"];
$viewquery="SELECT* FROM admin_panel 
WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'
 OR category LIKE '%$search%' OR post LIKE '%$search%' ";

}else{
    $postidfromurl=$_GET["id"];

$viewquery="SELECT * FROM admin_panel WHERE id='$postidfromurl' ORDER BY datetime desc";}
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
$postid=$datarows["id"];

//$datetime=$datarows["datetime"];
$datetime=strtotime($datarows['datetime']);

$title=$datarows["title"];
$category=$datarows["category"];
$admin=$datarows["author"];
$image=$datarows["image"];
$post=$datarows["post"];


   





?>

          <div class="card  w-80"style="background-color: #373b3c41;">
   <center class="card-title text-uppercase">
   <br>
   <span class="badge badge-pill badge-primary">
     
          <?php echo htmlentities($category); ?>
  </span>     
   <h3><?php  echo htmlentities($title); ?></h3>
   <small class="text-muted"> 
  ||&nbsp;<i class="fa fa-user">
  <?php echo htmlentities($admin); ?>&nbsp;||
  </i>     
  &nbsp;&nbsp;   
  <i class="fa fa-pen">
<?php 
$date = date('d-M-Y', $datetime);
echo htmlentities($date); ?>:&nbsp;
  </i>  
</small> 
 
  </center>

              <img class="img-thumbnail"src="upload/<?php echo $image; ?>" alt="">
  <div class="card-body">
        <div class="container">
<span class="float-left">
  <a class="btn btn-outline-info "href="blog.php?page=1">
  <i class="fa fa-backward">&nbsp;&nbsp;Back&nbsp;</i>
  </a>
  
  </span>&nbsp;&nbsp;


<br><br>


    <div class="row">
           
        <div class="col-sm-12 text-justified text-md-left pr-0">
           
   <p class="card-text"><?php
                echo nl2br($post);?></p>

        </div>
    </div>
</div>

            <div class="container">
             
            </div>
    </div>


</div>
<?php } ?>


<br><br><br>

<span class="fieldinfo">Share your Thoughts About This post  </span><br>
<span class="fieldinfo">Comments</span>

<form action="fullpost.php?id=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">

<label for="name"> <span class="fieldinfo"> Name:</span></label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-user"></i> </span>

</div>
<input required  name="name" class="form-control" type="text" placeholder="name">
</div>



<label for="name"> <span class="fieldinfo"> Comment:</span></label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-pen"></i></span>
</div>
<textarea required class="form-control" name="comment" id="comment"></textarea>
</div>
<br>
<span class="float-right">
  <input class="btn btn-outline-info " type="submit" value="submit" name="submit">
<br>

  </span>




</form>

<br><br>

<?php 
$connectingdb;
$postidforcomments=$_GET["id"];
$extractingcommentsquery="SELECT * FROM comments WHERE admin_panel_id='$postidforcomments'AND status='ON' ORDER BY id desc";
 $execute=mysqli_query($connection,$extractingcommentsquery);
while($datarows=mysqli_fetch_array($execute)){ 
$commentdate=$datarows["datetime"];
$commentername=$datarows["name"];
$commentbyusers=$datarows["comment"];

?>



<div class="media  text-white bg-dark p-2 mr-0" style="border-radius:15px"  >
  <a  href="#">
    <img src="images/default.png" class="d-flex align-self-center mr-3"  width=50px; height=50px alt="">
  </a>
  <div class="media-body ">
    <h5 class="text-warning"><?php echo $commentername;  ?></h5>
    <p class="description" ><small><?php echo $commentdate;  ?></small></p>
    <p><?php echo nl2br( $commentbyusers);  ?></p>

    </div>
</div>


<hr>
<?php  } ?> 



        </div>
<!--end of Main blog area ending-->

	<!--sidearea include-->
  <?php include("include/sidearea.php") ;  ?>

<!--sidearea include-->

   </div>  
   <a class="top-link hide" href="#" id="js-top">
<h1> <i class="fa fa-caret-up"></i>   </h1>
  <span class="screen-reader-text">Back to top</span>
</a>
   </div>  

 
               <!--body content-->

               <!--bootstrap 4  js online cdns-->
               <script src="bootstrap-4.4.1-dist/js/script.js"></script>
   <!--
     
    <script src="bootstrap-4.4.1-dist/js/jquery.slim.min.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
  <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>
 -->


</body>
</html>