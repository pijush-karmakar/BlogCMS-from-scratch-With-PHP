<?php  
  include 'inc/header.php';
  include 'inc/slider.php';
?>
<?php 
    if(!isset($_GET['category']) || $_GET['category']==NULL ){
    	header('Location:404.php');
    }
    else{
    	 $id = $_GET['category'];
    }
 ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
<?php 
   $query = "SELECT * FROM tbl_post WHERE cat=$id";
   $post = $db->select($query);
   if($post){ 
  	 while($result = $post->fetch_assoc()){ 


 ?>
<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4> <?php echo $fm->formatdate($result['date']); ?> , By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image'] ?>" alt="post image"/></a>

			    <?php echo $fm->textShorten($result['body']); ?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>

<?php }  } else{  ?>
		<p>No Post available in this category ! </p>
	<?php	} ?>
</div>

<?php  
  include 'inc/sidebar.php';
  include 'inc/footer.php';
?>