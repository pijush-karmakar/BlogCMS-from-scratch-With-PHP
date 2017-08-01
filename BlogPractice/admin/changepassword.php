<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
  
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
<?php 

   if(isset($_GET['usrId']) ){
           $usrId = (int)$_GET['usrId'];
           $Session_id = session::get('usrId');

           if($usrId != $Session_id){
                 header('Location:index.php');
              }
     }

     $db = new Database(); 

     if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass']) ){
       $updatePass = $db->UpdatePassword( $usrId,$_POST);

   }
 
   
 ?> 


       <div class="block">               
         <form action="" method="POST">
            <table class="form">
  					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                       
                        <input type="password" placeholder="Enter old Password..."  name="old_pass" class="medium" />
                    </td>
                </tr> 
				        <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="password" class="medium"  />
                        <input type="hidden" name="usrId" value="<?php echo session::get('usrId'); ?>" class="medium" />
                    </td>
                </tr>
				 
				
				       <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="updatepass" Value="Update" />
                    </td>
                </tr>

            </table>
            </form>
        </div>
    </div>
</div>

        
<?php  
  include 'inc/footer.php';
?>