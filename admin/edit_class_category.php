<?php

include_once '../config/Database.php';
include_once '../class/GroupCat.php';

$database = new Database();
$db = $database->getConnection();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>Sunny Admin - Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

  <?php
	include_once 'header.php';
	include_once 'sidebar.php';
  ?>
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
                <div class="col-md-12">
                    <div class="box">
					  
                      <div class="box-header with-border">
                        <h4 class="box-title">Edit Class Category</h4>
                      </div>
                      <form method="post" action="action/groupcat_action.php">
                      <div class="box-body">
                        <?php
                            $id = $_GET['id'];
                            $sql = $db->query("SELECT * FROM class_category WHERE id= $id");
                            if($sql->num_rows == 1){
                                foreach($sql as $data){?>
                                      <div class="form-group">
                                        <label>Category Name</label>
                                            <input type="text" class="form-control" placeholder="category name" 
                                            name="category_name" id="category_name" value="<?php echo $data['category_name'] ?>">
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $id ?>">           
                                        <button type="submit" class="btn btn-primary" name="update">Update Class Category</button>
                                    <?php

                                }
                                
                                
                              
                            }
                            
                        ?>
                          
                     </div>
                        </form>
                    </div>
                </div><!-- /.col-md-4 -->
            </div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <?php
	include_once 'footer.php';
  ?>

 
  
  
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->
	<script src="js/vendors.min.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>	
    <script src="../assets/vendor_components/datatable/datatables.min.js"></script>
	<script src="js/pages/data-table.js"></script>
	
	<!-- Sunny Admin App -->
	<script src="js/template.js"></script>
    <script type="text/javascript">
        function updateCat(id){
            var action = 'updateCat'
            var category_name = $('#category_name')
            console.log(id)
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{action:action, category_name:category_name},
                url:'action/groupcat_action.php'+id,
                success: function(data){
                    console.log(data)
                    if(data.success == true){
                        location.href = "http://localhost/class_management_system/admin/class_category.php"
                    }
                }
            })
        }
    </script>
	
	
</body>
</html>
