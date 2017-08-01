<meta name="language" content="English">

<!-- For Description  -->	
<?php 
		if(isset($_GET['id']) ){
		    $descrpId = $_GET['id'];
			   $query = "SELECT * FROM tbl_post WHERE id='$descrpId' ";
			   $Description = $db->select($query);
			   if($Description){
			   while($result = $Description->fetch_assoc() ){
 ?>	
	 <meta name="description" content="<?php echo $result['description']; ?>">
<?php } } } else { ?>
     <meta name="description" content="<?php echo DESCRIPTION ; ?>">
<?php   } ?>

<!-- For Keyword/tags -->
<?php 
		if(isset($_GET['id']) ){
		    $KeywordId = $_GET['id'];
			   $query = "SELECT * FROM tbl_post WHERE id='$KeywordId' ";
			   $keywords = $db->select($query);
			   if($keywords){
			   while($result = $keywords->fetch_assoc() ){
 ?>
     <meta name="keywords" content="<?php echo $result['tags']; ?>">
<?php } } } else { ?>
     <meta name="keywords" content="<?php echo KEYWORDS ; ?>">
<?php   } ?>

<!-- For Author -->
<?php 
		if(isset($_GET['id']) ){
		    $AuthorId = $_GET['id'];
			   $query = "SELECT * FROM tbl_post WHERE id='$AuthorId' ";
			   $Author = $db->select($query);
			   if($Author){
			   while($result = $Author->fetch_assoc() ){
 ?>
	 <meta name="author" content="<?php echo $result['author']; ?>">
<?php } } } else { ?>
     <meta name="author" content="<?php echo AUTHOR ; ?>">
<?php   } ?>