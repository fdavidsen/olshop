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