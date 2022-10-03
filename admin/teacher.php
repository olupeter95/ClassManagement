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
                            <h2 class="box-title">All Class</h2>
                            <a href="add_teacher.php" class="btn btn-info btn-md float-right">
                                <i class="fa fa-plus"></i>&nbsp; Add Teacher
                            </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th width="5%">ID</th>
                                                    <th class="sorting_asc" aria-sort="ascending" aria-controls="example1" 
                                                    aria-label="Name: activate to sort column descending">
                                                        Name
                                                    </th>
                                                    <th class="sorting_asc"aria-sort="ascending" aria-controls="example1" 
                                                    aria-label="Name: activate to sort column descending">
                                                        Email
                                                    </th>
                                                    <th class="sorting_asc" aria-sort="ascending" aria-controls="example1" 
                                                    aria-label="Name: activate to sort column descending">
                                                        Phone
                                                    </th>
                                                    <th class="sorting_asc" aria-sort="ascending" aria-controls="example1" 
                                                    aria-label="Name: activate to sort column descending">Address</th>
                                                    <th class="sorting_asc" aria-sort="ascending" aria-controls="example1" 
                                                    aria-label="Name: activate to sort column descending">Class Assigned</th>
                                                    <th width="30%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="teacher_info">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div><!-- /.col-md-8 -->
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
        function viewTeacher(){
            var action = 'viewTeacher'
            $.ajax({
                type:'post',
                dataType:'json',
                data:{action:action},
                url:'action/teacher_action.php',
                success: function(data){
                    var rows = ''
                    var i = 1
                    console.log(data)
                    $.each(data, function(key, value){
                        rows += `
                        <tr>
                                                    <td>${i++}</td>
                                                    <td>${value.name}</td>
													<td>${value.email}</td>
													<td>${value.phone}</td>
													<td>${value.address}</td>
                                                    <td>${value.class_name}</td>
                                                    <td>
                                                        <a href="edit_teacher.php?id=${value.id}" class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                        </a>
                                                        <a href="action/teacher_action.php?id=${value.id}&name=delTeacher" class="btn btn-danger delete">
                                                        <i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </td>
                                                </tr>`
                    }) 
                    $('#teacher_info').html(rows)
                }
            })
        }
        viewTeacher()
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
