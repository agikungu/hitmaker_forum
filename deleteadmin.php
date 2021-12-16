<?php  require_once("include/db.php");  ?>
<?php  require_once("include/sessions.php");  ?>
<?php  require_once("include/functions.php"); ?>

<?php 

$id = $_GET['id'];
 $viewquery="SELECT * FROM registration";
    $execute=mysqli_query($connection,$viewquery);
  
    while($datarows=mysqli_fetch_array($execute)){
     
           $link=$datarows["link"];
          $image=$datarows["image"];
          

    }


  $connectingdb;
//$query = "DELETE FROM registration WHERE id=".$id;

// $query="DELETE registration, admin_panel  FROM registration  INNER JOIN admin_panel  
 //WHERE registration.link = admin_panel.link and registration.link = '$link'";
//hii  ndio oriji
$query="DELETE FROM registration WHERE link='$id' ;";
$execute=mysqli_query($connection,$query);
if($execute){
  
////////////////////////////////////
       $connectingdb;
       $query2="SELECT * FROM admin_panel WHERE link='$id' ";
        $executequery=mysqli_query($connection,$query2);
        while($datarows=mysqli_fetch_array($executequery)){
             $imageupdate=$datarows["image"];
           
        }
////////////////////////////////////
//////hapa labda uengeneze ufanye link ya post ikuwe na jina zinafanana na mwenye ana deletiwa


  
$query3="DELETE FROM admin_panel WHERE link='$id' ;";
 //hii  ndio oriji
 mysqli_query($connection,$query3);
//delete the images in their respektive folders
unlink("upload/profile/$image");
//deleting ony one image (of the lates post ) but leaves the othe if the user had two images
unlink("upload/$imageupdate");

$_SESSION["successmessage"]=" Admin Account  Deleted Successfully";
redirect_to("admins.php");

}else{
  $_SESSION["errormessage"]=" Something went wrong try again";
  redirect_to("admins.php");

}

/////////////////////////////////////////

// Delete record
/*
$query = "DELETE FROM registration WHERE id=".$id;
//mysqli_query($con,$query);
$execute=mysqli_query($connection,$query);
if($execute){
  
$_SESSION["user_id"]=null;

$_SESSION["successmessage"]=" $imageupdate Admin Account  Deleted Successfully";
redirect_to("admins.php");

}else{
  $_SESSION["errormessage"]="$author Something went wrong try again";
  redirect_to("admins.php");

}

*/

//echo 1;
/*
$connectingdb;

  $query="DELETE registration, admin_panel  FROM registration  INNER JOIN admin_panel  
WHERE registration.link = admin_panel.link and registration.link = '$link'";
$execute=mysqli_query($connection,$query);
if($execute){
echo "KAmefutica";



}else {
    echo "KATAAAAAAAAAAAAAA";

    
}
*/
?>