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
  if(!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL ){
      echo "<script>window.location='postlist.php';</script>";
  }
  else{
		    $postid = $_GET['delpostid'];

		    $query ="SELECT * FROM tbl_post WHERE id='$postid' ";
		    $getdata = $db->select($query);
		    if($getdata){
		    	while($delImg = $getdata->fetch_assoc() ){
		            $delLink = $delImg['image'];
		            unlink($delLink);
		    	}
		    }
$delquery = "DELETE FROM tbl_post WHERE id = '$postid' ";
$deldata = $db->delete($delquery);
if($deldata){
	 echo "<script> alert('Data deleted successfully'); </script>";
     echo "<script>window.location='postlist.php';</script>";
}else{
	 echo "<script> alert('Data not deleted '); </script>";
     echo "<script>window.location='postlist.php';</script>";
}


  }

 ?>
