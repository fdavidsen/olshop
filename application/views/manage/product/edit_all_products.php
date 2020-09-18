<div class="row justify-content-center">
  <div class="input-group col-lg-8">
    <input type="text" class="form-control" placeholder="Search products (i.e. name and category)" aria-label="Search products (i.e. name and category)" aria-describedby="Search" autofocus id="manage_search">
    <div class="input-group-append">
      <select class="form-control btn border-secondary" id="manage_order-by">
        <option hidden selected value="">Sort by</option>
        <option value="id">latest</option>
        <option value="likes">like</option>
      </select>
    </div>
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
  <tbody id="products-list">
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
  </tbody>
</table>

<script type="text/javascript">
  $('#manage-container').removeClass('col-lg-9');
</script>