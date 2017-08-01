<?php  include '../lib/session.php';
       session::chkLogin();
 ?>
<?php 
  include '../config/config.php';
  include '../lib/Database.php';
  include '../helpers/format.php';

 ?>

 <?php 
	  $db =  new Database();
	  $fm = new format();
 ?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        	 $email = $fm->validation($_POST['email'] );
             $email = mysqli_real_escape_string($db->link, $email);

            if(!filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    echo "<span style='color:red; font-size=18px;' >Ivalid Email Address ! </span>";
              }
            else{ 

                  $emailquery = "SELECT * FROM tbl_user WHERE email='$email' limit 1";
                  $Chkemail = $db->select($emailquery);

                  if($Chkemail != false){

                 	     while ($value    =  $Chkemail->fetch_assoc() ) {
                               $userid    =  $value['id'] ;
                               $username  =  $value['username'] ;
                         } 

                         $text           =  substr($email, 0, 3);
                         $rand           =  rand(10000,99999);
                         $newpass        =  "$text$rand";
                         $password       =  md5($newpass);
                         $query          =  "UPDATE tbl_user SET password = '$password'  WHERE id='$userid' "; 
                         $updated_rows   =  $db->update($query); 

                         $to        =  "$email";
                         $from      =  "kpijush88@gmail.com";
                         $headers   =  "From: $from\n";
                         $headers  .=  'MIME-Version: 1.0' . "\r\n";
                         $headers  .=  'content-type : text/html ; charset = iso-8859-1' . "\r\n";
                         $subject   =  "Your Password";
                         $message   =  "Your Username is : " .$username. "and Password is : " . $newpass. "Please visit  website to LogIn ";

                         $sendmail = mail($to, $subject, $message, $headers); 
                         if($sendmail){
                             echo "<span style='color:green; font-size=18px;' >Please Check Your Email For New Password !</span>";
                         } 
                         else{
                            echo "<span style='color:red; font-size=18px;' >Email not Sent ! </span>";
                         } 

                }

                else{
                 	echo "<span style='color:red; font-size=18px;' >Email Not Exist !</span>";
                }

        }
    }
?>

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit"  value="Send Mail" />
			</div>
		</form><!-- form -->
        <div class="button">
            <a href="login.php">Log In</a>
        </div><!-- button -->
		<div class="button">
			<a href="#">Pijush Karmakar</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>