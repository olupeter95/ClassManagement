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
					  <form  method="post">
                      <div class="box-header with-border">
                        <h4 class="box-title">Add Student</h4>
                      </div>
                      <div class="box-body">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <?php
                                        $id = $_GET['id'];
                                        $sql = $db->query("SELECT s.name as sn, s.email as se, s.phone as sp,
                                        s.guardian_name as s_gn, s.address as sa, t.name as tn, c.class_name as cn, c.id as c_id,
                                        t.id as t_id FROM ((student as s INNER JOIN teacher as t ON s.teacher_id = t.id) INNER JOIN
                                        class as c ON s.class_id = c.id) WHERE s.id = $id"); 
                                        if($sql->num_rows == 1){
                                            foreach($sql as $data){?>
                                                 <input type="text" class="form-control" id="name" placeholder="name" 
                                                 value="<?php echo $data['sn']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="<?php echo $data['se']; ?>" class="form-control" id="email" placeholder="email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="<?php echo $data['sp']; ?>" id="phone" placeholder="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Guardian Name</label>
                                    <input type="text" class="form-control" value="<?php echo $data['s_gn']; ?>" id="guardian_name" placeholder="guardian name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="<?php echo $data['sa']; ?>" id="address" placeholder="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class Name</label>
                                    <select class="form-control" id="class_id" name="class_id" required>
                                        <option value="<?php echo $data['c_id']; ?>" selected>
                                            <?php echo $data['cn']; ?>
                                        </option>
                                    <?php
                                    $query = $db->query("SELECT * FROM class");
                                    if($query->num_rows > 0){
                                        while($rows = $query->fetch_assoc()){?>
                                        <option value="<?php echo $rows['id']?>">
                                        <?php echo $rows['class_name']?></option>
                                        <?php
                                        }
                                    }
                                ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class Teacher</label>
                                    <select class="form-control" id="teacher_id" name="teacher_id" required>
                                        <option value="<?php echo $data['t_id']; ?>" selected>
                                            <?php echo $data['tn']; ?>
                                        </option>
                                    <?php
                                    $query = $db->query("SELECT * FROM teacher");
                                    if($query->num_rows > 0){
                                        while($rows = $query->fetch_assoc()){?>
                                        <option value="<?php echo $rows['id']?>">
                                        <?php echo $rows['name']?></option>
                                        <?php
                                        }
                                    }
                                    $db->close();
                                ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                   
                            
                            
                      
                        
                            <button type="buton" id="<?php echo $id; ?>" onclick="updateStudent(this.id)" class="btn btn-primary" name="addStudent">
                            Update Student</button>
                    </form>
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
    <script>
        $(document).ready(function(){
        $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
        });
    });
   
    </script>
    
    <script type="text/javascript">
        function updateStudent(id){
            var name = $('#name').val()
            var email = $('#email').val()
            var phone = $('#phone').val()
            var guardian_name = $('#guardian_name').val()
            var address = $('#address').val()
            var class_id = $('#class_id').val()
            var teacher_id = $('#teacher_id').val()
            var action = 'updateStudent'
            $.ajax({
                type:'post',
                data: {name:name, email:email, phone:phone, guardian_name:guardian_name, address:address,
                class_id:class_id, teacher_id:teacher_id, action:action},
                url: 'action/student_action.php?id='+id,
                success: function(data){
                    console.log('updated successfully')
                }
            })
        }
               
    </script>
</body>
</html>
