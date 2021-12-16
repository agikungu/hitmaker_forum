<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>
<?php   
/*
    if ($_SESSION["user_id"]) {
//image
$connectingdb;
$user_id=$_SESSION["user_name"];
$userlink=$_SESSION["main_id"];
$viewquery="SELECT * FROM registration WHERE link='$userlink';";
$execute=mysqli_query($connection,$viewquery);
$srno=0;
while($datarows=mysqli_fetch_array($execute)){
 $profile=$datarows["image"];
   $username=$datarows["username"];
   $link=$datarows["link"];
}
//image
    }
    else {
//$_SESSION["errormessage"]="Login Required ";
      // redirect_to("login.php");
    }  
    */
    ?>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Blog</title>
   	<!--cdn include-->
  <?php include("include/cdns.php") ;  ?>
<!--cdn include-->
<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/style.css">

<style>

body {
   
    background-image: url("images/bg1.jpg");
    background-size: cover;
    background-repeat: no-repeat; 
}

 
 

    
</style>
</head>
<body  >
			<!--navbar include-->
<?php include("include/navbar.php") ;  ?>
			<!--navbar include-->

               <!--body content-->
     <!--container-->
 <div class="container-fluid">
  <section id="topSection" class="blue"></section>
 <div class="row">
 <!--search button--> 
 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">     
<br>   
<div class="card text-white bg-dark mb=-1">
<center>
<div class="card-header bg-dark"><h5 class="font-weight-bolder" style="font-family:stencil">HITMAKER MUSIC FORUM</h5></div>
</center>
<div class="card-body">
<form action="blog.php">
<div class="input-group">
  <input required type="text" name="search" class="form-control" placeholder="Search for posts/categories/keywords here...">
  <div class="input-group-prepend">
<span class="input-group">
  <button type="submit" name="searchbutton"><i class="fa fa-search"></i></button>
</span>
  </div>
</div>
</form>
</div>
</div>

</div>  
  <!--search button--> 

       <!--start of Main blog area --> 
   <div class="col-sm-12  col-md-9  col-lg-9 col-xl-9">
    
        <div class="row ">
<?php 
//When the search button is active
global $connectingdb;
if (isset($_GET["searchbutton"])) 
{
$search=$_GET["search"];
$viewquery="SELECT * FROM admin_panel 
WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'
 OR category LIKE '%$search%' OR post LIKE '%$search%' ORDER BY datetime desc ";
    $query_run = mysqli_query($connection,$viewquery);
 $rows=mysqli_num_rows($query_run);
?>
<?php
if ($rows==0) { ?> 
  <main class="container">
  <div class="row mt-2">
    <section class="col-md-12">      
      <div class="card text-center animated zoomIn slow p-5 shadow-lg">        
         <span><i class="far text-warning  fa-5x fa-frown"></i></span>        
        <p class="display-3  ">Oops!</p>    
           <i><h2 class="text-danger font-weight-bold my-1">Page Not Found</h2></i>          
        <p>no results available Found for  '<strong><?php echo $search; ?></strong>'</p>
       <a class="" href="blog.php?page=<?php echo 1; ?>">
        <button class="btn btn-primary btn-block rounded-pill">Go to HOME Page</button> 
        </a>       
      </div>
    </section>
  </div>
</main>

<!--
 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12  pt-2"> 
<div class="pb-1" >
<h3 class="bg-warning">oops!..no results Found for  '<strong><?php echo $search; ?></strong>'</h3> 
<a class="" href="blog.php?page=<?php echo 1; ?>">
<span class="btn btn-primary ">Back home</span>  </a>
</div>
</div> 
-->
<?php
}
else {
?>
 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12  pt-2"> 
<div class=" container bg-success">
<h3>  &nbsp; <strong class="bg-light"><?php echo $rows;  ?></strong>  Result(s) Found for  '<strong><?php echo $search;  ?></strong> '</h3>
</div>

<a href="blog.php?page=<?php echo 1; ?>">
<span class="btn btn-primary">Back home</span>  </a>
</div>

<?php } ?>

<?php
}
//Query when category is active
elseif (isset($_GET["category"])) {
$category=$_GET["category"];
$viewquery="SELECT * FROM admin_panel WHERE category='$category' ORDER BY datetime desc";
# code...
}
    //When the pagination is active
elseif (isset($_GET["page"])) {
  $page=$_GET["page"];
  if ($page==0||$page<1) {
    $showpostfrom=0;
    # code...
  }else {
    # code...
  $showpostfrom=($page*6)-6;}
 $viewquery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $showpostfrom,6";
}
else{
//The default query for blog.php
$viewquery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,6";}
?>
     <!---->
     <div class="col-lg-12 col-md-12">  
   	<!--slider include-->
     <?php  include("include/slider.php") ;  ?>
<!--slider include-->     
     </div>   
<?php
$execute=mysqli_query($connection,$viewquery);
     ?>


     <?php
while($datarows=mysqli_fetch_array($execute)){
$postid=$datarows["id"];
$datetime=strtotime($datarows['datetime']);
$date2=$datarows["datetime"];

//$date1 = strtr($datarows['datetime'], '/', '-');
$title=$datarows["title"];
$category=$datarows["category"];
$admin=$datarows["author"];
$image=$datarows["image"];
$post=$datarows["post"];
?>
      <div class="col-lg-6 col-md-6 "  >    
<!--=========================================================-->

              <!--=========================================================-->

         <div class="card boarder-rounded border-dark  "style="#background-color: #373b3c41;">
         <div class="waves-effect waves-light">
  <img class="card-img-top img-thumbnail "src="upload/<?php echo $image; ?>" alt=""  style="height: 250px">
  </div>
  <div class="card-body">
    <span class="float-right">    
<?php
$connectingdb;
$queryapproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$postid'AND status='ON'";
$executeapproved=mysqli_query($connection,$queryapproved);
$rowsapproved=mysqli_fetch_array($executeapproved);
$totalapproved=array_shift( $rowsapproved);
if ($totalapproved>0) {
?>
<?php } ?>
<small class="text-muted"> 
 &nbsp;<i class="fa fa-user">
  <?php echo htmlentities($admin); ?>&nbsp;&nbsp;&nbsp;
  </i>     
 </small>  
<span class="badge badge-primary">
      <?php echo htmlentities($category); ?> <br>
</span>
</span>
<h4 class="card-title font-weight-bold"><?php 
if (strlen($title)>30) 
{
$title=substr($title,0,30).'...' ; 
} echo $title ; ?>
</h4>
  
<p class="card-text"><?php
if (strlen($post)>100) {
  $post=substr($post,0,100).'...';
}
echo $post;?></p>  
  </div>
  <div class="d-flex justify-content-between align-items-center p-2">

                  <div class="btn-group">
          <button class="btn btn-sm btn-primary">
           <span class="badge badge-light"> <?php echo $totalapproved; ?>
            </span>
           <i class="fas fa-sms"></i>&nbsp;Comments&nbsp;         
                   
          </button>

            <a class="btn btn-outline-info " href="fullpost.php?id=<?php echo $postid; ?>">
  <i class="fa fa-eye">&nbsp;View</i>
  </a>

          </div>

                 <small class="text-muted"> 
                   <i class="fa fa-calendar-alt">
                          <?php 
                          $date = date('d-M-Y', $datetime);
                         // echo date('Y-m-d', strtotime($date1));
                         echo $date2;
                         // echo htmlentities($date); ?>:&nbsp;
                            </i>  
                   </small>

   </div>
  
</div>

<br>
        
    </div>   
<?php } ?>
<!--pagination-->
<div class="container">
<nav aria-label="Page navigation">
  <ul class="pagination">
  <?php 
if (isset($page)) {
if($page>1){
?>
    <li class="page-item">
      <a class="page-link"  href="blog.php?page=<?php echo $page-1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php }
}
?>
<?php
global $connectingdb;
$querypagination="SELECT COUNT(*) FROM admin_panel";
$executepagination=mysqli_query($connection,$querypagination);
$rowpagination=mysqli_fetch_array($executepagination);
$totalpost=array_shift($rowpagination);
//echo $totalpost;
$postpagination=$totalpost/6;
 $postpagination=ceil($postpagination) ;
 //echo $postperpage;
 for($i=1;$i<=$postpagination;$i++){
   if (isset($page)) {
      if($i==$page){
?>
    <li class="page-item active"><a class="page-link" href="blog.php?page=<?php echo $i; ?>"> <?php  echo $i; ?></a></li>
    <?php
   }else {  ?>
    <li class="page-item"><a class="page-link"href="blog.php?page=<?php echo $i; ?>"> <?php  echo $i; ?></a></li>
    <?php
  }
   }
} ?>
<!--Creating the Forward button-->
<?php 
if (isset($page)) {  # code...
if($page+1<=$postpagination){
?>
    <li class="page-item">
      <a class="page-link" href="blog.php?page=<?php echo $page+1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
<?php }
}
?>
  </ul>
</nav>
</div>
<!--pagination-->   
        </div><!--row ya ndani-->   
</div>
       <!--end of Main blog area --> 

<!--Side area uki include externally itakataakuwa side-->
<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <center>
    <!-- Button to Open the Modal -->
<center>

<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModal">
Create Post
</button>
</center>
    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-dark">
        <h4 class="modal-title text-light"><i class="fa fa-smile-o" aria-hidden="true"></i>Great</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
              <?php 
           if (isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
             echo 'Access your dashboard to start blogging<br>
              <a class="btn btn-outline-info "href="addnewpost.php">
  <i class="fa fa-blog">&nbsp;&nbsp; New Blog&nbsp;</i>
  </a>
             
              ';
               }
                        else {
                    echo ' But you must be a member first..<br>
                     <a class="btn btn-outline-info "href="register.php">
  <i class="fa fa-user">&nbsp;&nbsp;Register&nbsp;</i>
  </a>
                    ';}
                    ?>
       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
      <br> 
        <?php  /* */  ?>
        <div class="card border-dark mb-3">
            <div class="card-header text-white bg-dark ">
                <h5>Categories</h5>
            </div>
            <div class="card-body">
                <?php 
global $connectingdb;
$viewquery="SELECT * FROM category ORDER BY id desc";
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
$id=$datarows['id'];
$category=$datarows['name'];
?>
                <div class="i">
                    <a href="blog.php?category=<?php echo $category; ?>">
                        <P class="card-text font-weight-bolder" style=""> <?php echo $category."<br>";   ?></p>
                        <hr>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <?php  /* */  ?>
        <div class="card border-dark mb-3">
            <div class="card-header text-white bg-dark ">
                <h5>Recent posts</h5>
            </div>
            <div class="card-body">
                <?php
global $connectingdb;
$viewquery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
$id=$datarows["id"];
$title=$datarows["title"];
$datetime=strtotime($datarows['datetime']);
//$datetime=$datarows["datetime"];
$image=$datarows["image"];
$date = date('d-M-Y', $datetime);
if (strlen($date)>12) {
  $date=substr($date,0,12); 
# code...
}
?>
                <div class="i">
                    <a href="fullpost.php?id=<?php echo $id; ?>">
                        <img class="float-left" style="margin:10px;" src="upload/<?php echo htmlentities($image); ?>" alt="" srcset="" width=60; height=60;>
                        <P class="card-text" style=""><?php
if (strlen($title)>10) 
{
$title=substr($title,0,10).'...' ; 
} echo $title ;
?></p>
                    </a>
                    <P class="card-text" style=""><?php 
echo htmlentities($date)  ?></p>
                    <hr>
                </div>
                <?php }  ?>
            </div>
            <br>
    </center>
</div>
<!--Side area-->
<?php /**/  ?>
</div>


      <!--end of Main blog area ending--> 
<a class="top-link hide" href="#" id="js-top">
<h1> <i class="fa fa-caret-up"></i>   </h1>
  <span class="screen-reader-text">Back to top</span>
</a>
    </div> <!--ending of row-->      
    </div>
     <!--ending of container-->         
               <!--body content-->
               <!--bootstrap 4  js online cdns-->
   <!---->
   <!--bootstrap 4 online cdns-->
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