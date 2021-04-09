<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">SMK BPI Bandung</a>
  <span class="user-name petugas-name"><?= $this->session->nama; ?></span>
  <img class="img-circle img-petugas" src="<?= base_url() ?>assets/userImage/<?= $this->session->gambar; ?>">
</nav>
<!-- end navbar -->
<!-- sidebar -->
<div class="sidenav">
  <h3 class="manage">Management</h3>
  <div class="divider"></div>
  <div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('petugas/my_profile'); ?>"><i class="fa fa-fw fa-user"></i><span>Profile Saya</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('petugas/transaksi_pembayaran'); ?>"><i class="fa fa-fw fa-calculator"></i><span>Transaksi Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('petugas/history_pembayaran'); ?>"><i class="fa fa-fw fa-tasks"></i><span>History Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <div class="divider div-end"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('main/signout_petugas') ?>"><i class="fa fa-fw fa-chevron-circle-left"></i><span>Signout</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>
<!-- end sidebar -->