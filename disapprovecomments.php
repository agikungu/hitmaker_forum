<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php");  ?>
<?php  require_once("include/functions.php"); ?>
<?php
if (isset($_GET["id"])) {
    $idfromurl=$_GET["id"];
  $connectingdb;
  $query="UPDATE comments SET status='OFF' WHERE id='$idfromurl'";
  $execute=mysqli_query($connection,$query);
}
if($execute){
  $_SESSION["successmessage"]="Comment Diss-Approved Successfully";

  redirect_to("comments.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("comments.php");

}





?>