<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>

<?php 
 $userid   = session::get('usrId');
 $userrole = session::get('usrRole');  

 ?>

<style>
  /* edit post page */
.editpostimg img {
    border-radius: 6px;
    height: 120px;
    position: absolute;
    width: 125px;
}
.editpostimg {
    float: right;
    margin-right: 20%;
    margin-top: -120px;
    position: relative;
}
</style>


<div class="grid_10">

    <div class="box round first grid">
        <h2> User Profile </h2>
<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $name     = mysqli_real_escape_string($db->link, $_POST['name']);
               $username = mysqli_real_escape_string($db->link, $_POST['username'] );
               $email    = mysqli_real_escape_string($db->link, $_POST['email'] );
               $details  = mysqli_real_escape_string($db->link,$_POST['details'] );
              
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;


 if(empty($name) || empty($username) || empty($email) || empty($details)){
               echo "<span class='error'>Field must not be empty !</span>";
            }

 else{ 
if(!empty( $file_name) ){ 

      if ($file_size >1048567) {
           echo "<span class='error'>Image Size should be less then 1MB! </span>";
          } 

      elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
          } 

      else{  
              move_uploaded_file($file_temp, $uploaded_image);
              $query ="UPDATE tbl_user SET
                 name        = '$name',
                 username    = '$username',
                 email       = '$email',
                 details     = '$details',
                 image      = '$uploaded_image'
                 WHERE id='$userid'   "; 
           

              $updated_rows = $db->update($query);
              if ($updated_rows) {
                   echo "<span class='success'>User Data Updated Successfully.</span>";
              }else {
                   echo "<span class='error'> User Data Not Updated !</span>";
              }

        }

      

    }

    else{

            $query ="UPDATE tbl_user SET
                 name        = '$name',
                 username    = '$username',
                 email       = '$email',
                 details     = '$details'
                
                 WHERE id='$userid'   "; 
           

              $updated_rows = $db->update($query);
              if ($updated_rows) {
                   echo "<span class='success'>User Data Updated Successfully.</span>";
              } else {
                   echo "<span class='error'> User Data Not Updated !</span>";
              }
    }

  }



  

  }

?>
  

 <div class="block">  

<?php

     $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole ' ";
     $getuser = $db->select($query);
     if($getuser){ 
     while($result = $getuser->fetch_assoc() ){ 

 ?>
             
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>
               
                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                      
                     <input type="file" name="image" /> <br><br>
                     <div  class="editpostimg">
                       <img src="<?php echo $result['image']; ?>" >
                     </div> 
                    

                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="details">
                          <?php echo $result['details']; ?>
                        </textarea>
                    </td>
                </tr>

            
              
			        	<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>

            </table>
            </form>

<?php }  } ?>

        </div>
    </div>
</div>

       
<?php  
  include 'inc/footer.php';
?>




    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

    <!-- /TinyMCE -->
    <style type="text/css">
        #tinymce{font-size:15px !important;}
    </style>