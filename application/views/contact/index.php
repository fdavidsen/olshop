<div class="row justify-content-center">
	<div class="card col-lg-6">
	  <img class="w-50 mt-3 ml-25" src="<?= base_url(); ?>public/img/<?= $contact['picture']; ?>" class="card-img-top" alt="<?= $this->config->item('shop_name'); ?>">
	  <div class="card-body">
	    <h5 class="card-title text-center"><?= $contact['title']; ?></h5>
	    <h6 class="card-subtitle mb-2 text-muted text-center"><?= $contact['subtitle']; ?></h6>

	    <div class="multi-line mb-3"><?= $contact['description']; ?></div>
	  </div>
	</div>
</div>