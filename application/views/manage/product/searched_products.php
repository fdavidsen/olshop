<?php $i = 1; ?>
<?php foreach ($allProducts as $product) : ?>
  <tr>
    <th scope="row"><?= $i; $i++; ?></th>
    <td><?= $product['name']; ?></td>
    <td>
    	<a class="badge btn btn-outline-success p-2 mr-1" href="<?= base_url(); ?>manage/editProduct/<?= $product['id']; ?>">Edit</a>
			<a class="badge btn btn-outline-danger p-2 ml-1" onclick="return confirm('Are you sure?');" href="<?= base_url(); ?>manage/deleteProduct/<?= $product['id']; ?>">Delete</a>
		</td>
  </tr>
<?php endforeach; ?>