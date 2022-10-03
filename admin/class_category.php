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
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Class Category</h3>
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
                                                    <th>ID</th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" 
                                                    rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" 
                                                    style="width: 130.203px;">Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="info">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div><!-- /.col-md-8 -->
                <div class="col-md-4">
                    <div class="box">
					  
                      <div class="box-header with-border">
                        <h4 class="box-title">Add Class Category</h4>
                      </div>
                      <div class="box-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" id="category_name"
                                    name="category_name" placeholder="Category Name">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="addCat()">
                            Add Class Category</button>
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
        function viewCategory(){
            var action = 'viewCat'
            $.ajax({
                type:'post',
                dataType:'json',
                data:{action:action},
                url:'action/groupcat_action.php',
                success: function(data){
                    var rows = ''
                    var i = 1
                    console.log(data)
                    $.each(data, function(key, value){
                        rows += `
                        <tr>
                                                    <td>${i++}</td>
                                                    <td>${value.category_name}</td>
                                                    <td>
                                                        <a href="edit_class_category.php?id=${value.id}" class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                        </a>
                                                        <a href="action/groupcat_action.php?id=${value.id}&name=delCat" class="btn btn-danger delete">
                                                        <i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </td>
                                                </tr>`
                    }) 
                    $('#info').html(rows)
                }
            })
        }
        viewCategory()
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
        function addCat()
        {
            var category_name = $('#category_name').val()
            var action = 'addCat'
            $.ajax({
                type: 'post',
                url: 'action/groupcat_action.php?',
                data: {category_name:category_name, action:action},
                success: function(response){
                    result = JSON.parse(response)
                    console.log(result.message)
                    if(result.success = true){
                        viewCategory()
                        toastr.success(result.message) 
                    }   
                }
            })
        }
    </script>
</body>
</html>
