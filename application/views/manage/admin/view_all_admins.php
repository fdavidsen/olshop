<div class="row justify-content-center">
  <div class="input-group col-lg-6">
    <input type="text" class="form-control" placeholder="Search admins (i.e. name)" aria-label="Search admins (i.e. name)" aria-describedby="Search" autofocus id="search-admins">
  </div>
</div>

<table class="table text-center mt-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="admins-list">
    <?php $i = 1; ?>
    <?php foreach ($allAdmins as $admin) : ?>
      <tr>
        <th scope="row"><?= $i; $i++; ?></th>
        <td>
          <?= $admin['name']; ?>
          <?php if ($admin['id'] == $this->session->userdata('id')) : ?>
            <span class="badge badge-light ml-1">Me</span>
          <?php endif; ?>
        </td>
        <td>
        	<a class="badge btn btn-outline-success p-2 mr-1" href="<?= base_url(); ?>manage/viewAdmin/<?= $admin['id']; ?>">Visit</a>
  			</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script type="text/javascript">
  $('#manage-container').removeClass('col-lg-9').addClass('col');
</script>