<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php");  ?>
<?php  require_once("include/functions.php"); ?>
<?php
if (isset($_GET["id"])) {
    $idfromurl=$_GET["id"];
  $connectingdb;
  $admin=$_SESSION["user_name"];

  $query="UPDATE comments SET status='ON',approvedby='$admin' WHERE id='$idfromurl'";
  $execute=mysqli_query($connection,$query);
}
if($execute){
  $_SESSION["successmessage"]="Comment approved Successfully";

  redirect_to("comments.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("dashboard.php");

}





?>