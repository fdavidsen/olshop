<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group row">
		<div class="col">
			<label for="library" class="font-italic">Media Library</label>
			<div class="input-group">
			  <div class="custom-file">
			    <input type="file" multiple class="custom-file-input" id="library" aria-describedby="library" name="library[]">
			    <label class="custom-file-label overflow-hidden" for="library">Choose files</label>
			  </div>
			</div>
		</div>
	</div>

	<div class="form-group row mt-4">
		<div class="col">
			<label for="name" class="font-italic">Name</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
	</div>

	<div class="form-group row mt-4">
		<div class="col">
			<label for="category" class="font-italic">Category</label>
			<input type="text" class="form-control" id="category" name="category">
		</div>
	</div>

	<div class="form-group row mt-4">
		<div class="col">
			<label for="price" class="font-italic">Price</label>
			<div class="input-group mb-3">
			  <input type="text" class="form-control" id="price" name="price">
			  <div class="input-group-append">
			    <span class="input-group-text">IDR</span>
			  </div>
			</div>
		</div>
	</div>
	
	<div class="form-group row mt-3">
		<div class="col">
			<label for="description" class="font-italic">Description</label>
			<textarea class="form-control" id="description" name="description" rows="5"></textarea>
		</div>
	</div>

	<button type="submit" class="btn btn-dark float-right">Add</button>
</form>