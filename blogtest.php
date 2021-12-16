<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>


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
   

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
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
						<a class="nav-link" href="#"><i class="fa fa-address-book"></i> Contact </a>
					</li>
  
  </ul>
  <ul class="navbar-nav ml-auto">
				
        <li class="nav-item dropdown" style="padding: 15px; padding-bottom: 10px;">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Profile </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    
                      <a class="dropdown-item" href="dashboard.php"><i class="fas fa-user-cog"></i>&nbsp;dashboard</a>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Log out</a>
                                    </div>
      </li>
    </ul>
			</div>
      </nav>
      <br>  <br>  <br>
      
               <!--body content-->
              
            <div class="row">
 <!--Main blog Area-->
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 ">
            <h1>center area</h1>















        </div>
<!--end of Main blog area ending-->

<!--Side area-->
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4  ">
        <center>
        <h1>side area</h1>

         <div class="card text-white bg-dark mb-3" style="max-width: 14rem;">
        <div class="card-header"><h5>Search</h5></div>
        <div class="card-body">
        
        
        </div>
        </div>
        
        <div class="card text-white bg-dark mb-3" style="max-width: 14rem;">
        <div class="card-header"><h5>categories</h5></div>
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
  <P  class="card-text"style="" >  <?php echo $category."<br>";   ?></p>
  <hr>
  </a>
  </div>
  <?php } ?>    
     
    </div>
    </div>

<br><br>

<br><br>
<div class="card text-white bg-dark mb-3" style="max-width: 15rem;">
  <div class="card-header"><h5>Recent posts</h5></div>
  <div class="card-body">
  <?php
global $connectingdb;

$viewquery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
 $execute=mysqli_query($connection,$viewquery);
 while($datarows=mysqli_fetch_array($execute)){
$id=$datarows["id"];
$title=$datarows["title"];
$datetime=$datarows["datetime"];
$image=$datarows["image"];
if (strlen($datetime)>11) {
$datetime=substr($datetime,0,11); 
# code...
}


?>
<div class="i">
<a href="fullpost.php?id=<?php echo $id; ?>">
<img class="float-left" style="margin:10px;" src="upload/<?php echo htmlentities($image); ?>" alt="" srcset="" width=60; height=60;>
 <P  class="card-text"style="" ><?php echo htmlentities($title)  ?></p>
 </a>
 
  <P class="card-text" style=""  ><?php echo htmlentities($datetime)  ?></p>
<hr>
</div>

<?php }  ?>

</div>

<br>
</center>

 </div>   <!--ending of Side area-->
   </div>   
   </div>  
 
           
             
 
               



















               <!--body content-->







      
               <!--bootstrap 4  js online cdns-->
   <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
-->
   <!--bootstrap 4 online cdns-->

 

      <script src="bootstrap-4.4.1-dist/js/jquery.slim.min.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
  <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>



</body>
</html>