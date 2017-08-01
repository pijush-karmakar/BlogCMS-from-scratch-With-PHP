<?php  
  include 'inc/header.php';
?>

<?php 
    if(!isset($_GET['id']) || $_GET['id']==NULL ){
    	header('Location:404.php');
    }
    else{
    	 $id = $_GET['id'];
    }
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<?php 
			    $query = "SELECT * FROM tbl_post WHERE id=$id";
                  $post = $db->select($query);
                  if($post){ 
  	              while($result = $post->fetch_assoc() ){ 

			 ?>
				<h2><?php echo $result['title']; ?></h2>
				<h4> <?php echo $fm->formatdate($result['date']); ?> , By <a href=""><?php echo $result['author']; ?></a></h4>
				<img src="admin/<?php echo $result['image'] ?>" alt="post image"/>

			  <?php echo $result['body']; ?>

              
				
	
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
                       $catid = $result['cat'];
                       $rel_query = "SELECT * FROM tbl_post WHERE cat='$catid' ORDER BY rand() LIMIT 6";
	                   $rel_post = $db->select($rel_query);
	                   if($rel_post){ 
	  	               while($rel_result = $rel_post->fetch_assoc() ){ 
         

					 ?>
					<a href="post.php?id=<?php echo $rel_result['id']; ?>"><img src="admin/<?php echo $rel_result['image'] ?>" alt="post image"/></a>
					<?php } } else{
                            echo "No related post available !!! ";
						}  ?>
				</div>

				<?php }  }  else{ header('Location:404.php'); }  ?>

	</div>

</div>

<?php  
  include 'inc/sidebar.php';
  include 'inc/footer.php';
?>