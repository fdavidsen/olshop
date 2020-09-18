<form action="" method="POST">
  <input type="hidden" name="id" value="id">
  <div class="form-group row mt-4">
    <div class="col-4">
      <label for="old-password">Old Password</label>
    </div>
    <div class="col-8">
      <input type="password" class="form-control password" id="old-password" name="oldPassword" autofocus>
      <small class="form-text text-danger"><?= form_error('oldPassword'); ?></small>
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col-4">
      <label for="new-password">New Password</label>
    </div>
    <div class="col-8">
      <input type="password" class="form-control password" id="new-password" name="newPassword">
      <small class="form-text text-danger"><?= form_error('newPassword'); ?></small>
    </div>
  </div>

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="show-password" onclick="toggleVisibility()">
    <label class="custom-control-label" for="show-password">Show Password</label>
  </div>

  <button type="submit" class="btn btn-dark float-right mt-3">Change</button>
</form>