<?php 
  if (isset($_COOKIE['admin'])) {
    $this->Login_model->checkLoginCookie();
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/css/style.css">

    <title><?= $title; ?></title>
  </head>
  <body>
    <p id="base-url" hidden><?= base_url(); ?></p>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand pt-0" href="#"><?= $this->config->item('brand'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>contact">Contact</a>
            </li>

            <?php if ($this->session->userdata('admin') == TRUE) : ?>
              <li class="nav-item active">
                <a class="nav-link" href="<?= base_url(); ?>manage">Manage</a>
              </li>
            <?php endif; ?>
          </ul>

          <?php if ($this->session->userdata('admin') != TRUE) : ?>
            <a class="btn btn-sm btn-outline-secondary px-3 ml-md-auto" href="<?= base_url(); ?>login">Log in</a>
          <?php else : ?>
            <div class="btn-group ml-md-auto d-none d-lg-block w-4">
              <a role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle nav-pp" src="<?= base_url(); ?>public/img/profile_picture/<?= $admin['picture']; ?>" alt="<?= $admin['name']; ?>">
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <h6 class="text-center mt-1">Bye, <?= explode(' ', $admin['name'])[0]; ?></h6>
                <a class="btn btn-sm btn-outline-secondary mt-1 mb-2 ml-30" href="<?= base_url(); ?>login/logout">Log out</a>
              </div>
            </div>
            <a class="btn btn-sm btn-outline-secondary w-25 d-block d-lg-none d-xl-none" href="<?= base_url(); ?>login/logout">Log out</a>
          <?php endif; ?>
        </div>
      </div>
    </nav>

    <div class="container mt-3 mb-5" id="great-container">
      <div class="spinner-overlay">
        <div class="d-flex justify-content-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>