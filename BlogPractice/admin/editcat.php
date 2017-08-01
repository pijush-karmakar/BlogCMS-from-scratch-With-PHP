<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>

<?php 
  if(!isset($_GET['catid']) || $_GET['catid'] == NULL ){
    echo "<script>window.location='catlist.php';</script>";
    // header('Location:catlist.php');
  }
  else{
    $id = $_GET['catid'];
  }

 ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">

        <?php 
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $name = $_POST['name'];
               $name = mysqli_real_escape_string($db->link, $name);
               $userid = mysqli_real_escape_string($db->link,$_POST['userid'] );

            if(empty($name)){
               echo "<span class='error'>Field must not be empty !</span>";
            }
            else{
               $query = "UPDATE tbl_category SET name='$name',userid = '$userid' WHERE id='$id' ";
               $cat_update = $db->update($query);
               if($cat_update){
                echo "<span class='success'>Category Updated Successfully .</span>";
               }
               else{
                echo "<span class='error'>Category Not Updated !</span>";
               }
            }
         }

         ?>    

<?php 
 $query = "SELECT * FROM tbl_category WHERE id='$id' ORDER BY  id DESC";
 $category = $db->select($query);
 while($result = $category->fetch_assoc() ){ 
 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo session::get('usrId'); ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php } ?>
                </div>
            </div>
        </div>

        
<?php  
  include 'inc/footer.php';
?>