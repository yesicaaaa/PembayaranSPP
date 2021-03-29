<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">SMK BPI Bandung</a>
  <div class="btn-group btn-group-option">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      <img class="img-circle" width="15%" src="<?= base_url() ?>assets/img/<?= $this->session->gambar; ?>">
      <span class="user-name"><?= $this->session->nama; ?></span>
    </button>
    <ul class="dropdown-menu pull-right">
      <li><a href="<?= base_url('admin/my_profile') ?>"><i class="fa fa-fw fa-user"></i>Profile Saya</a></li>
      <li class="divider"></li>
      <li><a href="<?= base_url('main/signout_petugas'); ?>"><i class="fa fa-fw fa-chevron-circle-left"></i>Sign Out</a></li>
    </ul>
  </div>
</nav>
<!-- end navbar -->
<!-- sidebar -->
<div class="sidenav">
  <h3 class="manage">Management</h3>
  <div class="divider"></div>
  <div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin_data_petugas'); ?>"><i class="fa fa-fw fa-users"></i><span>Data Petugas</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin_data_siswa'); ?>"><i class="fa fa-fw fa-users"></i><span>Data Siswa</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin_data_kelas'); ?>"><i class="fa fa-fw fa-users"></i><span>Data Kelas</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin_data_spp'); ?>"><i class="fa fa-fw fa-users"></i><span>Data SPP</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/transaksi_pembayaran') ?>"><i class="fa fa-fw fa-users"></i><span>Transaksi Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/history_pembayaran'); ?>"><i class="fa fa-fw fa-users"></i><span>History Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/laporan') ?>"><i class="fa fa-fw fa-users"></i><span>Laporan</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>
<!-- end sidebar -->