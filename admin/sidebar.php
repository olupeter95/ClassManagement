<?php
include_once '../config/Database.php';
include_once '../class/Student.php';

$database = new Database();
$db = $database->getConnection();
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="../images/logo-dark.png" alt="">
						  <h3><b>Sunny</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li>
          <a href="dashboard.php">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>  
		
        <li>
          <a href="class_category.php">
            <i data-feather="message-circle"></i>
			      <span>Class Category</span>
          </a>
        </li>
        <li>
          <a href="class.php">
            <i data-feather="message-circle"></i>
			      <span>Class</span>
          </a>
        </li> 
        <li class="treeview">
          <a href="#">
            <i data-feather="user"></i>
            <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <?php
               $sql = $db->query("SELECT * FROM class_category");
               if($sql->num_rows > 0){
                  while($rows = $sql->fetch_assoc()){?>
                  <ul class="treeview" style="padding-right:20px">
                    
                    <a href="#">
                        <span><?php echo $rows['category_name']?></span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    
                        
                      <ul class="treeview-menu">
                        <?php
                          $id = $rows['id'];
                          $query = $db->query("SELECT * FROM class WHERE category_id = $id");
                          if($query->num_rows > 0){
                            while($data = $query->fetch_assoc()){?>
                                <li><a href="student.php?id=<?php echo $data['id']?>">
                                <i class="ti-more"></i><?php echo $data['class_name']?></a></li>
                              <?php
                            }
                          }
                        ?>
                          
                      </ul>  
                          
                        
                    
                  </ul>
                    <?php
                  }
               }
            ?>
        
          
        
            
            
          </ul>
        </li> 
        
        <li>
          <a href="teacher.php">
            <i data-feather="user"></i>
			      <span>Teacher</span>
          </a>
        </li>
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>