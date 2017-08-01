<?php  
  include 'inc/header.php';
  include 'inc/slider.php';
  include 'inc/paginator.php';
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">

                    

<?php 
                    $pages = new paginator('1','p');
                     $query = 'SELECT id FROM tbl_post';
					 $getpage = $db->select($query);

					// pass number of records to
					$pages->set_total( mysqli_num_rows($getpage) );


		
		     $query = "SELECT * FROM tbl_post ORDER BY id DESC ".$pages->get_limit();
			   $post = $db->select($query) ;
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

 <!--  end while-->
	<?php  } echo $pages->page_links();  ?> 



	<?php } else{
		header('Location:404.php');
		} ?>

</div>


<?php  
  include 'inc/sidebar.php';
  include 'inc/footer.php';
?>
	