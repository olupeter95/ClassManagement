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
                        <h4 class="box-title">Add Class</h4>
                      </div>
                      <div class="box-body">
                            <div class="form-group">
                                <label>Class Name</label>
                                <input type="text" class="form-control" id="class_name"
                                    name="class_name" placeholder="Class Name">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control" id="category_id" name="category_id">
                                <?php
                                $query = $db->query("SELECT * FROM class_category");
                                if($query->num_rows > 0){
                                    while($rows = $query->fetch_assoc()){?>
                                    <option value="<?php echo $rows['id']?>">
                                    <?php echo $rows['category_name']?></option>
                                    <?php
                                    }
                                }
                                $db->close();
                            ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="addClass()">
                            Add Class</button>
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
        function viewClass(){
            var action = 'viewClass'
            $.ajax({
                type:'post',
                dataType:'json',
                data:{action:action},
                url:'action/group_action.php',
                success: function(data){
                    var rows = ''
                    var i = 1
                    console.log(data)
                    $.each(data, function(key, value){
                        rows += `
                        <tr>
                                                    <td>${i++}</td>
                                                    <td>${value.class_name}</td>
                                                    <td>${value.category_name}</td>
                                                    <td>
                                                        <a href="edit_class.php?id=${value.id}" class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                        </a>
                                                        <a href="action/group_action.php?id=${value.id}&name=delClass" class="btn btn-danger delete">
                                                        <i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </td>
                                                </tr>`
                    }) 
                    $('#info').html(rows)
                }
            })
        }
        viewClass()
    </script>
	<script type="text/javascript">  
         $(document).on('click', '.delete', function(e){
             e.preventDefault();
             var link = $(this).attr("href");
             Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                      }
                    });
            });
    </script>
    <script type="text/javascript">
        function addClass(){
            var class_name = $('#class_name').val()
            var category_id = $('#category_id').val()
            var action = 'addClass'
            $.ajax({
                type: 'post',
                url: 'action/group_action.php',
                data: {class_name:class_name, category_id:category_id, action:action},
                success: function(data){
                    var result = JSON.parse(data)
                    if(result.success = true){
                        viewClass()
                        toastr.success(result.message)
                    }
                }
            })
        }
    </script>
</body>
</html>
