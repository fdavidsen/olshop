<?php 
	if ($this->session->userdata('admin') === TRUE) {
		redirect('manage');
		exit;
	}
?>

<div class="row justify-content-center mt-5">
  <div class="col-md-5">
  	<div class="alert alert-warning text-center" role="alert">
  		<?php if ($this->session->flashdata('status')) : ?>
  			<?php echo $this->session->flashdata('status'); ?>
  		<?php else : ?>
		  	This page is only for admin.
		  <?php endif; ?>
		</div>

	  <div class="card">
		  <div class="card-body">
		    <form action="" method="POST">
				  <div class="form-group">
				    <label for="username">Username</label>
				    <input type="text" class="form-control" id="username" aria-describedby="username" name="username" autofocus>
				  </div>

				  <div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" class="form-control password" id="password" name="password">
				  </div>

				  <div class="custom-control custom-switch float-right z-1">
				    <input type="checkbox" class="custom-control-input" id="show-password" onclick="toggleVisibility()">
				    <label class="custom-control-label" for="show-password">Show Password</label>
				  </div>
				  
				  <div class="form-group form-check mt-3">
				    <input type="checkbox" class="form-check-input" id="remember-me" name="rememberMe">
				    <label class="form-check-label" for="remember-me">Remember me</label>
				  </div>

				  <button type="submit" class="btn btn-dark" name="login">Log in</button>
				</form>
		  </div>
	  </div>
  </div>
</div>