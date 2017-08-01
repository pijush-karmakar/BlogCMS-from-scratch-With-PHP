<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>
  <?php  if(!session::get('usrRole')=='0'){  
   echo "<script>window.location='index.php';</script>";
 }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">

        <?php 
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
               $username    = $fm->validation($_POST['username'] );
               $password    = $fm->validation(md5($_POST['password'] ) );
               $email        = $fm->validation($_POST['email'] );
               $role        = $fm->validation($_POST['role'] );

               
               $username     = mysqli_real_escape_string($db->link, $username);
               $password     = mysqli_real_escape_string($db->link, $password);
               $email         = mysqli_real_escape_string($db->link, $email);
               $role         = mysqli_real_escape_string($db->link, $role);
               


if( empty($username) ||   empty($password) || empty($role) || empty($email)  ){
   echo "<span class='error'>Field must not be empty !</span>";
}

else{  
             $emailquery = "SELECT * FROM tbl_user WHERE email='$email' limit 1";
                                   $Chkemail = $db->select($emailquery);
            if( $Chkemail!=false){
               echo "<span class='error'> Email already Exist ! </span>";
            }

              else{
                       $query = "INSERT INTO tbl_user(username,password,role,email) VALUES ('$username','$password','$role','$email') ";
                       $userinsert = $db->insert($query);
                       if($userinsert){
                        echo "<span class='success'>User Created Successfully .</span>";
                       }
                       else{
                        echo "<span class='error'>User not Created!</span>";
                       }
                    }
         }
  }

?>        
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                       

                        <tr>
                                <td>
                                        <label >Username</label> 
                                </td>
                                <td>
                                  <input type="text" name="username" placeholder="Enter username..." class="medium" />
                                </td>
                        </tr>
                      
                       <tr>
                                <td>
                                        <label >Email</label> 
                                </td>
                                <td>
                                  <input type="email" name="email" placeholder="Enter Email Address..." class="medium" />
                                </td>
                        </tr>

                        <tr>
                                <td>
                                        <label >Password</label> 
                                </td>
                                <td>
                                  <input type="password" name="password" placeholder="Enter password..." class="medium" />
                                </td>
                        </tr>

                        <tr>
                                <td>
                                    <label >User Role</label> 
                                </td>
                                <td>
                                    <select name="role" id="select">
                                        <option>Select User Role</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Author</option>
                                        <option value="2">Editor</option>
                                    </select>
                                </td>
                        </tr>

                      

						            <tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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