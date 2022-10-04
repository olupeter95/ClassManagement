<footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)">FAQ</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Purchase Now</a>
		  </li>
		</ul>
    </div>
	  &copy; 2020 <a href="#">Psd to Html Expert</a>. All Rights Reserved.
  </footer>
  
  <script>
      if (sessionStorage.getItem(alert))
         var type = sessionStorage.getItem('alert'.alert-type) == 'info'
      switch (type) {
         case 'info':
            toastr.info(sessionStorage.getItem("alert".message));
            break;

         case 'success':
            toastr.success(sessionStorage.getItem("alert".message));
            break;

         case 'warning':
            toastr.warning(sessionStorage.getItem("alert".message));
            break;

         case 'error':
            toastr.error(sessionStorage.getItem("alert".message));
            break;
      }
      endif
   </script>
