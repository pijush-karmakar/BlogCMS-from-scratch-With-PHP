<?php  
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>

<?php 
  if(!isset($_GET['viewSliderId']) || $_GET['viewSliderId'] == NULL ){
    echo "<script>window.location='sliderlist.php';</script>";
  }
  else{
    $viewSlider = $_GET['viewSliderId'];
  }

 ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2> Slider </h2>
        <?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
echo "<script>window.location='sliderlist.php';</script>";
}

?>
  

    <div class="block">  

<?php

     $query = "SELECT * FROM tbl_slider WHERE id='$viewSlider' ORDER BY  id DESC";
     $getslider = $db->select($query);
     while($slideresult = $getslider->fetch_assoc() ){ 

 ?>
             
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Slider Title</label>
                    </td>
                    <td>
                        <input type="text" readonly  value="<?php echo $slideresult['title']; ?>" class="medium" />
                    </td>
                </tr>
             
             
           
                <tr>
                    <td>
                        <label> Image : </label>
                    </td>
                    <td>
                      <br>
                     <div  class="editpostimg">

                       <img src="<?php echo $slideresult['image']; ?>" height="100px" width="200px" >
                     </div> <br>
                    

                    </td>
                </tr>
               
                
			        	<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
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