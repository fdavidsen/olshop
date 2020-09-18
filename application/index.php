<div class="row justify-content-center mt-4">
  <div class="input-group col-lg-6">
    <input type="text" class="form-control" placeholder="Search products (i.e. name and category)" aria-label="Search products (i.e. name and category)" aria-describedby="Search" autofocus id="search">
    <div class="input-group-append">
      <select class="form-control btn border-secondary" id="order-by">
        <option hidden selected value="">Sort by</option>
        <option value="id">latest</option>
        <option value="likes">like</option>
      </select>
    </div>
  </div>
</div>

<hr class="mb-5" style="border-color: #a1ede6;">

<div class="row justify-content-center" id="products-list">
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
          <div class="row mt-3">
            <span class="badge badge-pill px-2 ml-3" style="margin-top: 0.7rem; background-color: #24f080;"><?= $product['category']; ?></span>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-dark ml-auto mr-3 see-detail" data-toggle="modal" data-target="#product-detail" data-id="<?= $product['id']; ?>">
            See Detail
            </button>
          </div>
			  </div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="product-detail" tabindex="-1" role="dialog" aria-labelledby="productDetailTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-name"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="carouselControls" class="carousel slide w-75 ml-12" data-ride="carousel" data-interval="false">
          <div class="carousel-inner"></div>
          <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <table class="table mt-3">
          <tbody>
            <tr> <td>Category</td>    <td id="category"></td>     </tr>
            <tr> <td>Price</td>       <td id="price"></td>        </tr>
            <tr> <td>Description</td> <td><div class="multi-line" id="description"></div></td> </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <span class="badge badge-pill px-3 py-2" id="like-counts" style="background-color: #24f080;"></span>
        <button type="button" class="btn btn-danger btn-sm text-white like"></button>
      </div>
    </div>
  </div>
</div>