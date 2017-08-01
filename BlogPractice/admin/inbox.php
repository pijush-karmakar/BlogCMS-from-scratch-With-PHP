<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
<?php 
if(isset($_GET['seenid']) ){
	$seenid = $_GET['seenid'];
	 $query = "UPDATE tbl_contact SET status='1' WHERE id='$seenid' ";
               $updated_row = $db->update($query);
               if($updated_row){
                echo "<span class='success'>Message sent in the Seen box Successfully .</span>";
               }
               else{
                echo "<span class='error'>Something Went Wrong !</span>";
               }
}
if(isset($_GET['unseenid']) ){
	$unseenid = $_GET['unseenid'];
	 $query = "UPDATE tbl_contact SET status='0' WHERE id='$unseenid' ";
               $updated_row = $db->update($query);
               if($updated_row){
                echo "<span class='success'>Message sent in the UnSeen box Successfully .</span>";
               }
               else{
                echo "<span class='error'>Something Went Wrong !</span>";
               }
}

 ?>        
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
			 		<th width="10%">Serial No.</th>
					<th width="12%">Name</th>
					<th width="15%">Email</th>
					<th width="20%">Message</th>
					<th width="12%">Date</th>
					<th width="18%">Action</th>
				</tr>
			</thead>
			<tbody>
  <?php 
	       $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
	       $msg = $db->select($query);
	       if($msg){
	       	 $i=0;
	       	 while($result = $msg->fetch_assoc() ){
             $i++;
 ?>			
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
					<td><?php echo $result['email'] ?></td>
					<td><?php echo $fm->textShorten($result['body'],30) ?></td>
					<td><?php echo $fm->formatdate($result['date']) ?></td>
					<td>
					    <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>

					<?php  if(session::get('usrRole')=='0'){  ?> 

                        || <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
                        <a onclick="return confirm('Are you sure to Move !');" href="?seenid=<?php echo $result['id']; ?>">Seen</a>

                    <?php }  ?>  

					</td>
				</tr>
			
<?php } } ?>				
			
			</tbody>
		</table>
       </div>
    </div>

        <div class="box round first grid">
        <h2>Seen Message</h2>
    <?php 
               if (isset($_GET['delid'])) {
                 	   $delid = $_GET['delid'];
                 	   $delquery = "DELETE FROM tbl_contact WHERE id='$delid' ";
                 	   $deldata = $db->delete($delquery);
                 	if($deldata){
                      echo "<span class='success'>Message Deleted Successfully .</span>";
                    }
                  else{
                      echo "<span class='error'>Message Not Deleted !</span>";
                    }
 
               }

       ?>     
        <div class="block">        
        <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="10%">Serial No.</th>
					<th width="12%">Name</th>
					<th width="15%">Email</th>
					<th width="20%">Message</th>
					<th width="12%">Date</th>
					<th width="18%">Action</th>
				</tr>
			</thead>
			<tbody>
  <?php 
	       $query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
	       $msg = $db->select($query);
	       if($msg){
	       	 $i=0;
	       	 while($result = $msg->fetch_assoc() ){
             $i++;
 ?>			
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
					<td><?php echo $result['email'] ?></td>
					<td><?php echo $fm->textShorten($result['body'],30) ?></td>
					<td><?php echo $fm->formatdate($result['date']) ?></td>
					<td>
					<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> 

                <?php  if(session::get('usrRole')=='0'){  ?> 

					|| <a onclick="return confirm('Are you sure to Move !');" href="?unseenid=<?php echo $result['id']; ?>">UnSeen</a> || 
					    <a onclick="return confirm('Are you sure to Delete !');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
                <?php }  ?>

					</td>
				</tr>
			
<?php } } ?>				
			
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