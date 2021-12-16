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

<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Document</title>
            <!--bootstrap 4 online cdns-->
            <!--
                 
                 
                  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
           
           <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
           
            -->
           <!--bootstrap 4 online cdns-->
           <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/sidestyle.css">
                <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
          
               <link rel="stylesheet" href="fontawesome5/css/fontawesome.css">
               <link rel="stylesheet" href="fontawesome5/css/solid.css">
               <link href="fontawesome5/css/brands.css" rel="stylesheet">

               <style>
    body{
background-image:url(images/bg1.jpg)

    }

</style>
               
</head>
<body >

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

      
<!--dbase table-->



        <div class="col col-sm-10 col-md-10 col-lg-10 col-xl-10 "style="  margin: 0 auto;background-color:#1779db38; border-radius:30px">

    
    <div>
      <br>
<?php  echo errormessage(); 
         echo successmessage(); 


?>

      </div>
      <center>
      <h3 style="font-family:stencil;color:wheat">Preview comment</h3>  
      
      </center>

<br><br>

<?php 
$connectingdb;
$postidforcomments=$_GET["id"];
$extractingcommentsquery="SELECT * FROM comments WHERE id='$postidforcomments'";
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
    
<span class="float-left">
  <a class="btn btn-outline-info "href="comments.php">
  <i class="fa fa-backward">&nbsp;&nbsp;Back&nbsp;</i>
  </a>
  
  </span>&nbsp;&nbsp;


<br>

    </div>
    <br>
</div>
<br>


 <?php }?>


    
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