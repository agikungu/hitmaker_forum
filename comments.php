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
   <title>Comments</title>

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
      <h3 style="font-family:stencil;color:wheat">Unpproved comments</h3>  
      
      </center>
<div class="table-responsive">
<table class="table table-striped table-dark " >
<thead class="thead-dark">
    <tr>
      <th>Number</th>
      <th>name</th>
      <th>Time</th>
      <th>comment</th>
      <th>post</th>
      <th>approve</th>
      <th>delete</th>

     <th>View</th>
    </tr>
    <thead class="thead-dark">
    <tbody>
    
<?php  

$connectingdb;
//$postidforcomments=$_GET["id"];
$user_id=$_SESSION["user_name"];
$viewquery="SELECT * FROM admin_panel WHERE author='$user_id';";
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
    $authorname=$datarows["link"];

}



//////////////////////////////////////////
$query="SELECT * FROM comments WHERE status='OFF' AND author='$authorname' ORDER BY id desc ";
 $execute=mysqli_query($connection,$query);
 $srno=0;
while($datarows=mysqli_fetch_array($execute)){
    
$commentid=$datarows['id'];
//$datetimeofcomment=$datarows['datetime'];
$datetime=strtotime($datarows['datetime']);
$personname=$datarows['name'];
$personcomment=$datarows['comment'];
$pname=$datarows['postname'];


$commentedpostid=$datarows['admin_panel_id'];
$srno++;
if (strlen($personcomment)>18) 
{
$personcomment=substr($personcomment,0,18).'...' ; 
}
if (strlen($personname)>10) 
{
$name=substr($personname,0,10).'...' ; 
}


?>
<tr>
<td><?php echo htmlentities( $srno) ; ?></td>
<td><?php echo htmlentities( $personname)  ; ?></td>
<td><?php
$date = date('d-M-Y', $datetime);
if (strlen($date)>13) 
{
$date=substr($date,0,13).'...' ; 
}
echo $date;  ?></td>
<td><a class="text-info"  href="viewcomment.php?id=<?php echo $commentid; ?>"><?php echo htmlentities($personcomment)  ; ?></a></td>
<td><?php echo htmlentities($pname)  ; ?></td>

<td><a class="text-success"  href="approvecomments.php?id=<?php echo $commentid; ?>"><i class="fas fa-fast-forward"></i></a></td>
<td><a class="text-danger" href="deletecomments.php?id=<?php  echo $commentid;?>"><i class="fas fa-trash"></i></td>
<td><a href="viewcomment.php?id=<?php echo $commentid; ?>"><i class="fas fa-eye"></i></a></td>
 

</tr>
<?php } ?>
</tbody>
</table>
<br>

<hr>

  <center>
<h3 style="font-family:stencil;color:wheat">approved comments</h3>  
</center>
<br>
<div class="table-responsive">
<table class="table table-striped table-dark " >
<thead class="thead-dark">
    <tr>
      <th>Number</th>
      <th>name</th>
      <th>Time</th>
      <th>commment</th>
      <th>Post Title</th>
      <th>approve</th>
      <th>delete</th>

     <th>Preview</th>
    </tr>
    <thead class="thead-dark">
    <tbody>
    
<?php  

$connectingdb;
$admin="Kaggz";
//$postidforcomments=$_GET["id"];

$user_id=$_SESSION["user_name"];
$viewquery="SELECT * FROM admin_panel WHERE author='$user_id';";
$execute=mysqli_query($connection,$viewquery);
while($datarows=mysqli_fetch_array($execute)){
    $authorname=$datarows["link"];

}
//$query="SELECT * FROM comments WHERE status='ON' AND author='$authorname'  ORDER BY id  desc ";
$query="SELECT * FROM comments WHERE status='ON' AND author='$authorname' ORDER BY id desc ";

 $execute=mysqli_query($connection,$query);
 $srno=0;
while($datarows=mysqli_fetch_array($execute)){
    
$commentid=$datarows['id'];
$datetime=strtotime($datarows['datetime']);
$personname=$datarows['name'];
$personcomment=$datarows['comment'];
$pname=$datarows['postname'];

$approvedby=$datarows['approvedby'];

$commentedpostid=$datarows['admin_panel_id'];
$srno++;
if (strlen($personcomment)>18) 
{
$personcomment=substr($personcomment,0,18).'...' ; 
}
if (strlen($personname)>10) 
{
$name=substr($personname,0,10).'...' ; 
}

?>
<tr>
<td><?php echo htmlentities( $srno); ?></td>
<td><?php echo htmlentities( $personname); ?></td>
<td><?php
$date = date('d-M-Y', $datetime);
if (strlen($date)>13) 
{
$date=substr($date,0,13).'...' ; 
}
echo $date;  ?></td>
<td><?php echo htmlentities($personcomment); ?></td>
<td><?php echo  htmlentities($pname); ?></td>

<td><a class="text-warning"  href="disapprovecomments.php?id=<?php echo $commentid;?>"><i class="fas fa-fast-backward"></i></a></td>
&nbsp;&nbsp;
<td>
<a class="text-danger"  href="deletecomments.php?id=<?php echo $commentid;?>"><i class="fas fa-trash"></i></a>
</td>
<td>
<a href="fullpost.php?id=<?php echo $commentedpostid; ?>" target="_blank"><i class="fas fa-rocket"></i></a></td>
</tr>
<?php } ?>
</tbody>
</table>

      
<!--dbae table-->

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