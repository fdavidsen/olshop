<?php foreach ($allProducts as $product) : ?>
	<div class="col-md-4 mb-3">
		<div class="card">
      <?php if (isset($productsFirstFile[$product['id']])) : ?>
        <?php if ($productsFirstFile[$product['id']]['type'] == 'image') : ?>
          <img src="<?= base_url(); ?>public/product/<?= $productsFirstFile[$product['id']]['file_name']; ?>" class="card-img-top" alt="<?= $product['name']; ?>">
        <?php elseif ($productsFirstFile[$product['id']]['type'] == 'video') : ?>
          <video src="<?= base_url(); ?>public/product/<?= $productsFirstFile[$product['id']]['file_name']; ?>" class="embed-responsive embed-responsive-4by3" controls loop></video>
        <?php endif; ?>
      <?php else : ?>
        <img src="<?= base_url(); ?>public/img/no_image_available.jpg" class="card-img-top w-75 ml-12" alt="No image available">
      <?php endif; ?>

		  <div class="card-body">
		    <h5 class="card-title"><?= $product['name']; ?></h5>
        <div class="multi-line p-limit-3 mb-2" style="height: 4.5rem;"><?= $product['description']; ?></div>

        <div class="row">
          <div class="col-7 float-left">
            <span class="badge badge-pill px-2 pb-1 mt-2" style="background-color: #24f080;"><?= $product['category']; ?></span>
          </div>
          <div class="col-5 float-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-dark see-detail" data-toggle="modal" data-target="#product-detail" data-id="<?= $product['id']; ?>">
            See Detail
            </button>
          </div>
        </div>
		  </div>
		</div>
	</div>
<?php endforeach; ?>