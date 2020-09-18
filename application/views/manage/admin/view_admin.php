<div class="card col-sm-10">
  <img class="mt-3 rounded-circle pp" src="<?= base_url(); ?>public/img/profile_picture/<?= $visitedAdmin['picture']; ?>" class="card-img-top" alt="<?= $visitedAdmin['name']; ?>">
  <div class="card-body">
    <h5 class="card-title mt-3"><?= $visitedAdmin['name']; ?></h5>
    <div class="multi-line"><?= $visitedAdmin['description']; ?></div>

    <table class="table text-center mt-3">
      <thead>
        <tr>  <th scope="col" colspan="2">Actions</th>  </tr>
      </thead>
      <tbody>
        <tr>
          <td class="w-50">Add</td>
          <td><?= $visitedAdmin['addition']; ?></td>
        </tr>
        <tr>
          <td class="w-50">Edit</td>
          <td><?= $visitedAdmin['edit']; ?></td>
        </tr>
        <tr>
          <td class="w-50">Delete</td>
          <td><?= $visitedAdmin['deletion']; ?></td>
        </tr>
      </tbody>
    </table>

    <div class="float-right mt-4">
    	<?php if ($visitedAdmin['id'] == $this->session->userdata('id')) : ?>
	    	<a href="<?= base_url(); ?>manage/editProfile" class="btn btn-sm btn-outline-success">Edit Profile</a>
	    <?php endif; ?>

    	<a href="<?= base_url(); ?>manage/viewAllAdmins" class="btn btn-sm btn-dark">Back</a>
    </div>
  </div> 
</div>

<script type="text/javascript">
  $('#manage-container').removeClass('col-9').addClass('col');
</script>