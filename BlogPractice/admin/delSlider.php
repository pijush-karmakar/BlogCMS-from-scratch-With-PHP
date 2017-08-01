<?php  include '../lib/session.php';
       session::chkSession();
 ?>
<?php 
  include '../config/config.php';
  include '../lib/Database.php';
  include '../helpers/format.php';

 ?>

 <?php 
      $db =  new Database();    
 ?>

<?php 
  if(!isset($_GET['delSliderId']) || $_GET['delSliderId'] == NULL ){
      echo "<script>window.location='sliderlist.php';</script>";
  }
  else{
		    $delSliderId = $_GET['delSliderId'];

		    $query ="SELECT * FROM tbl_slider WHERE id='$delSliderId' ";
		    $getslider = $db->select($query);
		    if($getslider){
		    	while($delImg = $getslider->fetch_assoc() ){
		            $delLink = $delImg['image'];
		            unlink($delLink);
		    	}
		    }
$delquery = "DELETE FROM tbl_slider WHERE id = '$delSliderId' ";
$deldata = $db->delete($delquery);
if($deldata){
	 echo "<script> alert('Slider deleted successfully'); </script>";
     echo "<script>window.location='sliderlist.php';</script>";
}else{
	 echo "<script> alert('Slider not deleted '); </script>";
     echo "<script>window.location='sliderlist.php';</script>";
}


  }

 ?>
