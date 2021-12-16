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
if (isset($_POST["submit"])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
  $category=mysqli_real_escape_string( $connection, $_POST["category"]);
date_default_timezone_set("Africa/Nairobi");
$currenttime=time();
//$datetime=strftime("%Y-%m-%d %H: %M: %S",$currenttime);
$datetime=strftime("%B-%d-%Y %H: %M: %S",$currenttime);
$admin=$_SESSION["user_name"];

if (empty($category)) {

  $_SESSION["errormessage"]="All fields must be filled";

redirect_to("categories.php");

 
}elseif (strlen($category)>99) {

  $_SESSION["errormessage"]="Name too long... please use a shorter name";

redirect_to("categories.php");

 
} else {
global $connectingdb;
$query="INSERT INTO category(datetime,name,creatorname) VALUES ('$datetime','$category','$admin')";
//hapa pia ukitumia old mysql query bila parameters mbili itakataa
$execute=mysqli_query($connection,$query);
if($execute){
  $_SESSION["successmessage"]="Category added succesfully";

redirect_to("categories.php");

}else{
  $_SESSION["errormessage"]="Something went wrong";

  redirect_to("categories.php");

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
   <title>Categories</title>

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
               
</head>
<body >

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

        <div class="col col-sm-10 col-md-10 col-lg-10 col-xl-10 "style="  margin: 0 auto;background-color:#1779db38; border-radius:30px">

    
<div>
  <br>
<?php  echo errormessage(); 
     echo successmessage(); 


?>

  </div><br>
  <center>
<h1 style="font-family:stencil">Manage Categories</h1>  
</center>

<form action="categories.php" method="post" class="needs-validation" novalidate>
<div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="text" id="uname" placeholder="Add new Category" autocomplete="off" name="category" required>
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-book"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>

            <br>
    <input class="btn btn-info btn-block" type="submit" value="Add" name="submit"><br>

<a href="dashboard.php" >
<input class="btn btn-success btn-block" type="button" value="Back" >
</a>
  </form>
<div class="table-responsive">
<table class="table table-striped table-dark " >
<thead class="thead-dark">
<tr>
<th>SR No.</th>
          <th>Date & time</th>
          <th>Category Name</th>
          <th>Creator name</th>
          <th>Action</th>
   </tr>

   </thead>
    <tbody>

   <?php
   global $connectingdb;
   //hapa ORDER BY haifai kuwa imeshikana kama ya jazeb
   $viewquery="SELECT * FROM category ORDER BY id desc";
   //hapa pia ukitumia old mysql query bila parameters mbili itakataa
   $execute=mysqli_query($connection,$viewquery);
  $srno=0;


   while($datarows=mysqli_fetch_array($execute)){
      $id=$datarows["id"];
      $datetime=$datarows["datetime"];
      $categoryname=$datarows["name"];
      $creatorname=$datarows["creatorname"];
      $srno++;
    
  
   
   ?>
   <tr>
                <td><?php  echo  $srno;   ?></td>
                <td><?php  echo  $datetime   ; ?></td>
                <td><?php  echo  $categoryname  ;  ?></td>
                <td><?php  echo  $creatorname;    ?></td>
                <td><a class="text-danger" href="deletecategory.php?id=<?php echo $id; ?>">
                <i class="fas fa-trash"> </i>&nbsp; Delete 
                </a></td>

   </tr>
<?php    }   ?>
</tbody>
</table>

<!--end transparent form main area-->
    
    </div><!--Ending of row-->
    
  
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