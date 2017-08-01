<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
				    <th>No</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php

$query = "SELECT * FROM tbl_slider";
$slider = $db->select($query);
if($slider){
	$i = 0;
	while($result = $slider->fetch_assoc() ){ 
      $i++;

 ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="80px" width="150px" /> </td>
					     
           <td>
           <a href="viewslider.php?viewSliderId=<?php echo $result['id']; ?>">View</a>

			<?php  if(session::get('usrRole')=='0'  ){  ?>
					     
					|| <a href="editSlider.php?editSliderid=<?php echo $result['id']; ?>">Edit</a>      
					||<a onclick="return confirm('Are you sure to Delete !');"  href="delSlider.php?delSliderId=<?php echo $result['id']; ?>">Delete</a> </td>
			<?php  }  ?>
					 
				</tr>
			<?php  }  } ?>

			</tbody>
		</table>

       </div>
    </div>
</div>
 



<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
    
<?php  
  include 'inc/footer.php';
?>
