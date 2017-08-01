</div>

<div class="footersection templete clear">
	<div class="footermenu clear">
	    <ul>
<?php 

    $path = $_SERVER['SCRIPT_FILENAME'];
    $currentPage = basename($path,'.php');

 ?>
 
<li><a href="index.php">Home</a></li>
<?php 
           $query = "SELECT * FROM tbl_page ORDER BY id DESC";
           $pages = $db->select($query);
           if($pages){
           while($result = $pages->fetch_assoc() ){

 ?> 
 <li><a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
     
 <?php } } ?>

 <li><a href="contact.php">Contact</a></li>
			
	</ul>
</div>

    <?php 
           $query = "SELECT * FROM tbl_copyright WHERE id='1' ";
           $copyright = $db->select($query);
           if($copyright){
           while($result = $copyright->fetch_assoc() ){

    ?>
	  <p>&copy; <?php echo $result['note']; ?> <?php echo date('Y'); ?></p>
<?php }  }  ?>
	</div>
	<div class="fixedicon clear">
	 <?php 
           $query = "SELECT * FROM tbl_social WHERE id='1' ";
           $socialmedia = $db->select($query);
           if($socialmedia){
           while($result = $socialmedia->fetch_assoc() ){

     ?>
		<a href="<?php echo $result['fb']; ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw']; ?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['ln']; ?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp']; ?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>

	<?php } }  ?>
		
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>