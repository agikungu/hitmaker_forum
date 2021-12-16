<?php  require_once("include/db.php"); ?>
<?php  require_once("include/sessions.php"); ?>
<?php  require_once("include/functions.php"); ?>

<?php

if (isset($_POST["submit"])) {
  //hii ya jazeb haikuwa na $connection na ilikuwa mysql bila i
 $username=mysqli_real_escape_string( $connection, $_POST["username"]);
 $password=mysqli_real_escape_string( $connection, $_POST["password"]);



if (empty($username)||empty($password)) {

  $_SESSION["errormessage"]="All fields must be filled";

redirect_to("login.php");

 
}
else {

$query="SELECT * FROM registration WHERE username='$username' AND password='$password'";
        $query_run = mysqli_query($connection,$query);
        if(mysqli_num_rows($query_run)>0)
        {
            $row =mysqli_fetch_assoc($query_run);


          $_SESSION["user_name"]= $row['username'];
          $_SESSION["user_id"]= $row['id'];
          $_SESSION["main_id"]= $row['link'];

          //check super admin
          $admin="kaggz";
            if ($_SESSION[user_name]==$admin) 
{
   $_SESSION['admin']=true;
}
   //check super admin
                
            $_SESSION['loggedin']=true;
         
            
  $_SESSION["successmessage"]="Congrats {$_SESSION["user_name"]}.. Welcome to Nganyeweb";

    redirect_to("dashboard.php");

        }else {
      

      
  $_SESSION["errormessage"]="wrong username or password  ";

redirect_to("login.php");
    }




//////////////////////////////////////////////////////////////////
/*
    $found_account= login_attempt($username,$password);
$_SESSION["User_id"]=$found_account["id"];

    if($found_account){


  $_SESSION["successmessage"]="Welcome  successfull {$_SESSION["User_id"]}  ";

redirect_to("dashboard.php");

    }else {
      

      
  $_SESSION["errormessage"]="wrong username or password  {$_SESSION["User_id"]}";

redirect_to("login.php");
    }
    */

}

  # code...
}







?>

<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Login Page</title>
       
   	<!--cdn include-->
  <?php include("include/cdns.php") ;  ?>

<!--cdn include-->
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
 			<!--navbar include-->
<?php include("include/navbar.php") ;  ?>
			<!--navbar include-->

    <br><br>
    

<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6"style=" background-color:#1779db38; border-radius:30px">     <br>
        <div class="container-fluid bg-info text-" style="height:60px; font-family:stencil; border-radius:20px;margin:0 auto;">
    <center>
  <h2>LOGIN</h2></center>
    </div><br>
        <br>

        <center>
       
    <?php  echo errormessage(); 
         echo successmessage(); 
         ?>

      
</center>
<form action="login.php" method="post" class="needs-validation" novalidate>
<div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="text" id="uname" placeholder="Enter username" autocomplete="off" name="username" required>
                <span class="input-group-append">
                    <div class="input-group-text "><i class="fa fa-user"></i></div>
                </span>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>

       <div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="password" id="pwd" placeholder="Enter password" autocomplete="off" name="password" required>
                <span class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </span>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <br>
    <input class="btn btn-primary btn-block" type="submit" value="Login" name="submit"><br>

<a href="register.php" >
<input class="btn btn-success btn-block" type="button" value="Register" >
</a>
  </form>
</div>
                        </div>
                        </div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</div>
<!--
      <script src="bootstrap-4.4.1-dist/js/jquery.slim.min.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.js"></script>
  <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
  <script src="fontawesome5/js/fontawesome.js"></script>
  <script src="fontawesome5/js/fontawesome.min.js"></script>

-->

</body>
</html>