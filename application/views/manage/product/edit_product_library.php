<div class="row">
	<div class="col">
		<a href="<?= base_url(); ?>manage/editProduct/<?= $productLibrary[0]['product_id']; ?>" class="btn btn-dark btn-sm px-4 ml-2 mb-3">Back</a>
	</div>
	<div class="col-8 mr-2">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="productId" value="<?= $productLibrary[0]['product_id']; ?>">

			<div class="input-group">
			  <div class="custom-file">
			    <input type="file" multiple class="custom-file-input" id="newLibrary" aria-describedby="newLibrary" name="library[]">
			    <label class="custom-file-label overflow-hidden" for="newLibrary">Add more files</label>
			  </div>
			  <div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="submit">Upload</button>
			  </div>
			</div>
		</form>
	</div>
</div>

<table class="table">
  <tbody>
  	<?php foreach ($productLibrary as $prodLib) : ?>
	    <tr>
	      <td class="w-50">
	      	<?php if ($prodLib['type'] == 'image') : ?>
	      		<img src="<?= base_url(); ?>public/product/<?= $prodLib['file_name']; ?>" class="w-100" alt="<?= $product['name']; ?>">
	      	<?php elseif ($prodLib['type'] == 'video') : ?>
	      		<video src="<?= base_url(); ?>public/product/<?= $prodLib['file_name']; ?>" class="w-100" controls loop></video>
	      	<?php endif; ?>
				</td>
	      <td>
	      	<form action="<?= base_url(); ?>manage/changeLibraryFile/" method="POST" enctype="multipart/form-data">
	      		<input type="hidden" name="productId" value="<?= $prodLib['product_id']; ?>">
	      		<input type="hidden" name="id" value="<?= $prodLib['id']; ?>">
	      		<input type="hidden" name="oldFile" value="<?= $prodLib['file_name']; ?>">

	      		<div class="input-group mt-3">
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" id="newFile<?= $prodLib['id']; ?>" aria-describedby="newFile<?= $prodLib['id']; ?>" name="newFile<?= $prodLib['id']; ?>">
						    <label class="custom-file-label overflow-hidden" for="newFile<?= $prodLib['id']; ?>">Choose file</label>
						  </div>
						  <div class="input-group-append">
						    <button class="btn btn-sm btn-outline-success" type="submit">Change</button>
						  </div>
						</div>
					</form>

					<div class="form-group row justify-content-center mt-4">
						<a href="<?= base_url(); ?>manage/deleteLibraryFile/<?= $prodLib['file_name'] . '/' . $prodLib['product_id'] . '/' . $prodLib['id']; ?>" class="btn btn-outline-danger btn-sm px-4" onclick="return confirm('Are you sure?');">Delete</a>
					</div>
	      </td>
	    </tr>
  	<?php endforeach; ?>
  </tbody>
</table>

<script type="text/javascript">
  $('#manage-container').removeClass('col-lg-9');
</script>