<form action="" method="POST">
  <div class="form-group row">
    <div class="col">
      <label for="picture" class="font-italic">Picture</label>
      <button type="button" class="btn btn-outline-success ml-5" data-toggle="modal" data-target="#changePicture">
        Edit
      </button>
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col">
      <label for="Title" class="font-italic">Title</label>
      <input type="text" class="form-control" id="Title" name="title" value="<?= $contact['title']; ?>">
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="col">
      <label for="sub-title" class="font-italic">Subtitle</label>
      <input type="text" class="form-control" id="sub-title" name="subtitle" value="<?= $contact['subtitle']; ?>">
    </div>
  </div>

  <div class="form-group row mt-4">
		<div class="col">
			<label for="description" class="font-italic">Description</label>
		  <textarea class="form-control" id="description" name="description" rows="5"><?= $contact['description']; ?></textarea>
		</div>
	</div>
	
  <button type="submit" class="btn btn-dark float-right mt-3">Update</button>
</form>



<!-- Modal -->
<div class="modal fade" id="changePicture" tabindex="-1" role="dialog" aria-labelledby="changePictureTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePictureTitle"><?= $this->config->item('shop_name'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>manage/editContactPicture" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="oldPicture" value="<?= $contact['picture']; ?>">
  
          <div class="col-md-8 offset-md-2">
            <img src="<?= base_url(); ?>public/img/<?= $contact['picture']; ?>" class="w-100" alt="<?= $this->config->item('shop_name'); ?>">
          </div>

          <div class="col-md-10 offset-md-1 mt-4">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="picture" aria-describedby="picture" name="newPicture">
                <label class="custom-file-label overflow-hidden" for="picture">Choose files</label>
              </div>
            </div>
            <button type="submit" class="btn btn-dark float-right my-5">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>