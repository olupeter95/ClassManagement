<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>Sunny Admin - Registration </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">	

</head>

<body class="hold-transition theme-primary bg-gradient-primary">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top-agile p-10">
							<h2 class="text-white">Class Management System</h2>
							<p class="text-white-50">Admin Registration</p>							
						</div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
							<form method="post">
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
										<input type="text" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Full Name"
										id="name">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-email"></i></span>
										</div>
										<input type="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email"
										id="email">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
										<input type="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password"
										id="password">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
										<input type="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Retype Password"
										id="confirm_password">
										<span class="text-danger" id="error"></span>
									</div>
								</div>
								  <div class="row">
									<div class="col-12">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" >
										<label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
									  </div>
									</div>
									<!-- /.col -->
									<div class="col-12 text-center">
									  	<button type="button" class="btn btn-info btn-rounded margin-top-10" onclick="reg()">
											SIGN IN
										</button>
									</div>
									<!-- /.col -->
								  </div>
							</form>													


							<div class="text-center">
								<p class="mt-15 mb-0 text-white">Already have an account?
									<a href="../index.php" class="text-danger ml-5"> Sign In</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="js/vend
	ors.min.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>	
	<script type="text/javascript">
		function reg(){
			var name = $('#name').val()
			var email = $('#email').val()
			var password = $('#password').val()
			var confirm_password = $('#confirm_password').val()
			var action = 'regAdmin'
			if(confirm_password != password){
				var error = 'password do not match'
				$('#error').html(error)
				console.log('password do not match')
			}else{
				$.ajax({
					type: 'post',
					url: '../user_action.php',
					data: {name:name, email:email, password:password, action:action},
					success: function(data){
						

					}
				})
			}
		}
	</script>	
	
</body>
</html>
