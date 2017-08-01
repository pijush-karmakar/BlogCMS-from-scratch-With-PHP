<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Website Theme</h2>
               <div class="block copyblock">

  <?php 
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
               $theme = mysqli_real_escape_string($db->link,$_POST['theme'] );

               $query = "UPDATE tbl_theme SET theme='$theme' WHERE id='1' ";
               $theme_update = $db->update($query);
               if($theme_update){
                echo "<span class='success'>Theme Updated Successfully .</span>";
               }
               else{
                echo "<span class='error'>Theme Not Updated !</span>";
               }
            
    }

  ?>    

<?php 
 $query = "SELECT * FROM tbl_theme WHERE id='1' ";
 $theme = $db->select($query);
 while($result = $theme->fetch_assoc() ){  
 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input 
                                <?php if($result['theme']=='default' ) {echo"Checked";} ?>
                                type="radio"  name="theme" Value="default">Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input 
                                <?php if($result['theme']=='green' ) {echo"Checked";} ?>
                                type="radio" name="theme" Value="green">Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input
                                <?php if($result['theme']=='red' ) {echo"Checked";} ?>
                                 type="radio" name="theme" Value="red">Red
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input
                                <?php if($result['theme']=='blue' ) {echo"Checked";} ?>
                                 type="radio" name="theme" Value="blue">Blue
                            </td>
                        </tr>
					            	<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php  }  ?>
                </div>
            </div>
        </div>

        
<?php  
  include 'inc/footer.php';
?>