<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php");  ?>
<?php  require_once("include/functions.php"); ?>
<?php
if (isset($_GET["id"])) {
    $idfromurl=$_GET["id"];
  $connectingdb;
  $query="DELETE FROM category WHERE id='$idfromurl'";
  $execute=mysqli_query($connection,$query);
}
if($execute){
  $_SESSION["successmessage"]="category Deleted Successfully";

  redirect_to("categories.php");

}else{
  $_SESSION["errormessage"]="Something went wrong try again";

  redirect_to("categories.php");

}





?>