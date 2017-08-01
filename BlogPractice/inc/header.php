<?php 
  include 'config/config.php';
  include 'lib/Database.php';
  include 'helpers/format.php';

 ?>

 <?php 
	  $db =  new Database();
	  $fm = new format();
 ?>
<?php 
if(isset($_GET['pageid']) ){
	$pagetitleId = $_GET['pageid'];
	 $query = "SELECT * FROM tbl_page WHERE id='$pagetitleId' ";
	   $pages = $db->select($query);
	   if($pages){
	   while($result = $pages->fetch_assoc() ){  ?>

<title><?php echo $result['name']; ?> - <?php echo TITLE; ?></title>

 <?php } } } 
elseif(isset($_GET['id']) ){
	   $postId = $_GET['id'];
	   $query = "SELECT * FROM tbl_post WHERE id='$postId' ";
	   $posts = $db->select($query);
	   if($posts){
	   while($result = $posts->fetch_assoc() ){  ?>

<title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>

 <?php } } } else{  ?>

<title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>

 <?php } ?>


<!DOCTYPE html>
<html>
<head>

<?php include 'scripts/meta.php'; ?>	
<?php include 'scripts/css.php'; ?>
<?php include 'scripts/js.php'; ?>

</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
	 <?php 
           $query = "SELECT * FROM title_slogan WHERE id='1' ";
           $blog_title = $db->select($query);
           if($blog_title){
           while($result = $blog_title->fetch_assoc() ){

     ?>  
				<img src="admin/<?php echo $result['logo'] ?>" alt="Logo"/>
				<h2><?php echo $result['title'] ?></h2>
				<p><?php echo $result['slogan'] ?></p>

	<?php } } ?>
				
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
    <?php 
           $query = "SELECT * FROM tbl_social WHERE id='1' ";
           $socialmedia = $db->select($query);
           if($socialmedia){
           while($result = $socialmedia->fetch_assoc() ){

     ?>

			<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
	<?php } }  ?>			
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
	<?php 

    $path = $_SERVER['SCRIPT_FILENAME'];
    $currentPage = basename($path,'.php');

	 ?>
		<li><a 
<?php if($currentPage =='index'){ echo 'id="active"'; } ?>
		href="index.php">Home</a></li>
	<?php 
           $query = "SELECT * FROM tbl_page ORDER BY id DESC";
           $pages = $db->select($query);
           if($pages){
           while($result = $pages->fetch_assoc() ){

     ?> 
     <li><a 
<?php 
  if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id'] ){
  	 echo ' id="active" ';
  }
 ?>
     href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
     
     <?php } } ?>
     	
		<li><a <?php if($currentPage =='contact'){ echo 'id="active"'; } ?>
		 href="contact.php">Contact</a></li>
	</ul>
</div>