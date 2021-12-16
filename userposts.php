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
   <title>Blogs</title>
   
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
<h1 style="font-family:stencil">Admin's Dashboard</h1>  
</center>
<div class="table-responsive">
<table class="table table-striped table-dark " >
<thead class="thead-dark">
    <tr>
      <th>Number</th>
      <th>Post Title</th>
      <th>Time</th>
      <th>Author</th>
      <th>Category</th>
      <th>Banner</th>
      <th>Comments</th>
      <th>Action</th>
      <th>Preview</th>
      
    </tr>
  </thead>
    <tbody>
    <?php
    $connectingdb;
     $user_id=$_SESSION["user_name"];
    $viewquery="SELECT * FROM admin_panel;";
    $execute=mysqli_query($connection,$viewquery);
    $srno=0;
    while($datarows=mysqli_fetch_array($execute)){
      $id=$datarows["id"];
      $datetime=$datarows["datetime"];
      $title=$datarows["title"];
      $category=$datarows["category"];
      $admin=$datarows["author"];
      $image=$datarows["image"];
      $post=$datarows["post"];
      $main=$datarows["link"];

      $srno++;

    
    
    ?>
<tr>
<td><?php echo $srno ; ?></td>
<td style="color:wheat"><?php
if (strlen($title)>20) 
{
$title=substr($title,0,20).'...' ; 
} echo $title ; ?></td>
<td><?php
if (strlen($datetime)>13) 
{
$datetime=substr($datetime,0,13).'...' ; 
}
echo $datetime;  ?></td>
<td><?php
if (strlen($admin)>6) 
{
$admin=substr($admin,0,6).'...' ; 
}
echo $admin;  ?></td>
<td><?php
if (strlen($category)>8) 
{
$category=substr($category,0,8).'...' ; 
}
echo $category ; ?></td>
<td><img src="upload/<?php echo $image ; ?>" width="100px" height="8%"></td>
<td>
<?php
$connectingdb;
$queryapproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id'AND status='ON'";
$executeapproved=mysqli_query($connection,$queryapproved);
$rowsapproved=mysqli_fetch_array($executeapproved);
$totalapproved=array_shift( $rowsapproved);
if ($totalapproved>0) {
  


?>

<span class="badge badge-success">
<?php echo $totalapproved; ?>
</span>
<?php } ?>
&nbsp;&nbsp;


<?php
$connectingdb;
$queryunapproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id'AND status='OFF'";
$executeunapproved=mysqli_query($connection,$queryunapproved);
$rowsunapproved=mysqli_fetch_array($executeunapproved);
$totalunapproved=array_shift( $rowsunapproved);
if ($totalunapproved>0) {
  


?>

<span class="badge badge-warning">
<?php echo $totalunapproved; ?>
</span>
<?php } ?>


</td>
<td>
						 <?php if($_SESSION['main_id']==$main||isset($_SESSION['admin'])):?>

 
  <a href="editpost.php?edit=<?php echo $id; ?>"><i class="fas fa-edit"></i></span> </a> 
  &nbsp;&nbsp;
  <a class="text-danger" href="deletepost.php?delete=<?php echo $id; ?>"><i class="fas fa-trash"></i></a>
  
                  <?php endif;?>

</td>
<td><a href="fullpost.php?id=<?php echo $id; ?>" target="_blank">
<i class="fas fa-fast-forward"></i>

 </td>



</tr>

  <?php } ?>
</tbody>
</table>


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