<?php

include_once '../config/Database.php';

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <!-- Script--> 
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
                        <h4 class="box-title">Add Teacher</h4>
                      </div>
                      <div class="box-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" placeholder="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" placeholder="email" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="phone" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" placeholder="address" required>
                            </div>
                            <div class="form-group">
                                <label>Class Name</label>
                                <select class="form-control" id="class_id" name="class_id" required>
                                    <option value="" selected>Select Class</option>
                                <?php
                                $query = $db->query("SELECT * FROM class");
                                if($query->num_rows > 0){
                                    while($rows = $query->fetch_assoc()){?>
                                    <option value="<?php echo $rows['id']?>">
                                    <?php echo $rows['class_name']?></option>
                                    <?php
                                    }
                                }
                                $db->close();
                            ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="addTeacher()">
                            Add Teacher</button>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function addTeacher(){
            var name = $('#name').val()
            var email = $('#email').val()
            var phone = $('#phone').val()
            var address = $('#address').val()
            var class_id = $('#class_id').val()
            var action = 'addTeacher'
            $.ajax({
                type: 'post',
                url: 'action/teacher_action.php',
                data: {name:name, email:email, phone:phone, address:address, 
                class_id:class_id, action:action},
                success: function(data){
                    var result = JSON.parse(data)
                    if(result.success = true){
                        toastr.success(result.message)
                    }
                    location.href = "http://localhost/classmanagement/admin/teacher.php"
                }
            })
        }
    </script>
</body>
</html>
