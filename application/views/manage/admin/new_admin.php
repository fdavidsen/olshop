<form action="" method="POST">
  <div class="form-group row">
    <div class="col-4">
      <label for="picture">Profile Picture</label>
    </div>
    <div class="col-8">
      <div class="row">
        <div class="col">
          <label for="mele">
            <img src="<?= base_url(); ?>public/img/profile_picture/male.png" class="w-75" alt="Male">
          </label>
          <input type="radio" class="ml-35" name="picture" id="mele" value="male.png" checked>
        </div>
        <div class="col">
          <label for="femele">
            <img src="<?= base_url(); ?>public/img/profile_picture/female.png" class="w-75" alt="Female">
          </label>
          <input type="radio" class="ml-35" name="picture" id="femele" value="female.png">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col-4">
      <label for="name">Full Name</label>
    </div>
    <div class="col-8">
      <input type="text" class="form-control" id="name" name="name">
      <small class="form-text text-danger"><?= form_error('name'); ?></small>
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col-4">
      <label for="username">Username</label>
    </div>
    <div class="col-8">
      <input type="text" class="form-control" id="username" name="username">
      <small class="form-text text-danger"><?= form_error('username'); ?></small>
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col-4">
      <label for="password">Password</label>
    </div>
    <div class="col-8">
      <input type="password" class="form-control password" id="password" name="password">
      <small class="form-text text-danger"><?= form_error('password'); ?></small>
    </div>
  </div>

  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="show-password" onclick="toggleVisibility()">
    <label class="custom-control-label" for="show-password">Show Password</label>
  </div>

  <button type="submit" class="btn btn-dark float-right mt-3">Register</button>
</form>