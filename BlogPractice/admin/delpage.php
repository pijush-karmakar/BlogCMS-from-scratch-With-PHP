<?php  include '../lib/session.php';
       session::chkSession();
 ?>
<?php 
  include '../config/config.php';
  include '../lib/Database.php';

 ?>

 <?php 
      $db =  new Database();    
 ?>

<?php 
  if(!isset($_GET['delpageid']) || $_GET['delpageid'] == NULL ){
      echo "<script>window.location='index.php';</script>";
  }
  else{

  $pagetid = $_GET['delpageid'];
		    
$delquery = "DELETE FROM tbl_page WHERE id = '$pagetid' ";
$deldata = $db->delete($delquery);
if($deldata){
	 echo "<script> alert('Page deleted successfully'); </script>";
     echo "<script>window.location='index.php';</script>";
}else{
	 echo "<script> alert('Page not deleted '); </script>";
     echo "<script>window.location='index.php';</script>";
}


  }

 ?>
