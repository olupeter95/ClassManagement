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
    
    <!-- Script--> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

     
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
                        <h4 class="box-title">Edit Class</h4>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                            <label for="class_name">Class Name</label>
                            <?php
                                $id = $_GET['id'];
                                $sql = $db->query("SELECT class.id as id, class_category.id as c_id, class_name,
                                category_name FROM class INNER JOIN class_category 
                                ON class.category_id = class_category.id WHERE class.id= $id");
                                if($sql->num_rows == 1){
                                    foreach($sql as $row){?>
                                        <input type="text" id="class_name" class="form-control"
                                        value="<?php echo $row['class_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control" id="category_id">
                                <option value="<?php echo $row['c_id']?>">
                                    <?php echo $row['category_name']?>
                                </option>
                            
                                        <?php
                                    }
                                }
                                $query = $db->query("SELECT * FROM class_category");
                                if($query->num_rows > 0){
                                    while($rows = $query->fetch_assoc()){?>
                                        <option value="<?php echo $row['id']?>">
                                            <?php echo $rows['category_name']?>
                                        </option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>    
                        <button type="button" id="<?php echo $id?>" class="btn btn-primary" onclick="updateClass(this.id)">
                            Update Class</button>
                      </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
	
	<!-- Sunny Admin App -->
	<script src="js/template.js"></script>
    <script type="text/javascript">
        function updateClass(id){
            var class_name = $('#class_name').val()
            var category_id = $('#category_id').val()
            var action = 'updateClass'
            $.ajax({
                type: 'post',
                data: {class_name:class_name, category_id, action:action},
                url: 'action/group_action.php?id='+id,
                success: function(data){
                    var result = JSON.parse(data)
                    if(result.success = true){
                        location.href = "http://localhost/classmanagement/admin/class.php"
                        toastr.success(result.message)
                    }
                }
            })
        }
    </script>
	
	
</body>
</html>
