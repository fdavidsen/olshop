<?php 
  if ($this->session->userdata('admin') !== TRUE) {
    redirect('login');
    exit;
  }
?>

<!-- Custom styles for this template -->
<link href="<?= base_url(); ?>public/css/sidebar.css" rel="stylesheet">
<!-- Bootstrap core JavaScript for sidebar -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar-wrapper bg-light border-right text-center">
    <div class="heading bg-light sticky-top">Admin Panel</div>

    <div class="list-group list-group-flush mb-5">
      <div>
        <p class="title mt-0">Product</p>

        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage">New Product</a>
        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/editAllProducts">Edit Products</a>
      </div>
      
      <div>
        <p class="title">Contact</p>

        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/editContact">Edit Contact</a>
      </div>

      <div>
        <p class="title">Profile</p>

        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/editProfile">Edit Profile</a>
        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/changePassword">Change Password</a>
      </div>

      <div>
        <p class="title">Admin</p>

        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/viewAllAdmins">View Admins</a>
        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/newAdmin">New Admin</a>
      </div>
      
      <div>
        <p class="title">Account</p>

        <a class="list-group-item list-group-item-action d-none" href="<?= base_url(); ?>manage/deleteAccount">Delete Account</a>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="content-wrapper">
    <!-- navbar-expand-lg -->
    <nav class="navbar navbar-light bg-light border-bottom">
      <button class="navbar-toggler" id="menu-toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <div class="content container-fluid">
      <div class="col-lg-9 mt-3" id="manage-container">
        <?php if ($this->session->flashdata('status')) : ?>
          <div class="alert alert-warning text-center pb-2 mb-5" role="alert">
            <?= $this->session->flashdata('status'); ?>
          </div>
        <?php endif; ?>