<form action="" method="POST">
  <input type="hidden" name="id" value="id">
  <p>Once you delete your account, there is no going back. Please be certain.</p>
  <p class="mt-4">To verify, type your <label class="font-italic" for="password">password</label> below:</p> 

  <div class="form-group mt-4">
    <input type="password" class="form-control password" id="password" name="password">
  </div>

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="show-password" onclick="toggleVisibility()">
    <label class="custom-control-label" for="show-password">Show Password</label>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-danger float-right mt-3" onclick="return confirm('Are you sure?');">Delete</button>
  </div>
</form>