<a href="<?= base_url(); ?>manage/editAllProducts/" class="btn btn-dark btn-sm px-4 mb-3">Back</a>

<div class="form-group row">
	<div class="col">
		<label for="mediaLibrary" class="font-italic">Media Library</label>
		
		<?php if (count($productLibrary) > 0) : ?>
			<a href="<?= base_url() ?>manage/editProductLibrary/<?= $product['id']; ?>" class="btn btn-outline-success btn-sm ml-5 px-4">Edit</a>
		<?php else : ?>
			<form action="<?= base_url(); ?>manage/addFirstFile/" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $product['id']; ?>">

				<div class="input-group">
				  <div class="custom-file">
				    <input type="file" class="custom-file-input" id="newFile" aria-describedby="newFile" name="newFile">
				    <label class="custom-file-label overflow-hidden" for="newFile">Choose file</label>
				  </div>
				  <div class="input-group-append">
				    <button class="btn btn-sm btn-outline-success" type="submit">Upload</button>
				  </div>
				</div>
			</form>
		<?php endif; ?>
	</div>
</div>

<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group row mt-3">
		<div class="col">
			<label for="name" class="font-italic">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?= $product['name']; ?>">
		</div>
	</div>

	<div class="form-group row mt-4">
		<div class="col">
			<label for="category" class="font-italic">Category</label>
			<input type="text" class="form-control" id="category" name="category" value="<?= $product['category']; ?>">
		</div>
	</div>

	<div class="form-group row mt-4">
		<div class="col">
			<label for="price" class="font-italic">Price</label>
			<div class="input-group mb-3">
			  <input type="text" class="form-control" id="price" name="price" value="<?= $product['price']; ?>">
			  <div class="input-group-append">
			    <span class="input-group-text">IDR</span>
			  </div>
			</div>
		</div>
	</div>
	
	<div class="form-group row mt-3">
		<div class="col">
			<label for="description" class="font-italic">Description</label>
			<textarea class="form-control" id="description" name="description" rows="5"><?= $product['description']; ?></textarea>
		</div>
	</div>

	<div class="form-group row mt-5">
		<div class="col-4">
			<label class="font-italic">Likes</label>
		</div>
		<div class="col-8">
			<p><?= $product['likes']; ?></p>
		</div>
	</div>

	<button type="submit" class="btn btn-dark float-right">Update</button>
</form>