<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">SMK BPI Bandung</a>
  <span class="user-name petugas-name"><?= $this->session->nama; ?></span>
  <img class="img-circle img-petugas" src="<?= base_url() ?>assets/userImage/<?= $this->session->gambar; ?>">
</nav>
<!-- end navbar -->
<!-- sidebar -->
<div class="sidenav">
  <div>
    <div class="divider div-siswa"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('siswa/index'); ?>"><i class="fa fa-fw fa-user"></i><span>Profile Saya</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('siswa/history_pembayaran'); ?>"><i class="fa fa-fw fa-tasks"></i><span>History Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <h4 class="date date-siswa"><?= date('l, d M Y'); ?></h4>
    <h4 id="timestamp"></h4>
    <div class="divider div-end-siswa"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('main/signout_siswa') ?>"><i class="fa fa-fw fa-chevron-circle-left"></i><span>Signout</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>
<!-- end sidebar -->

<script>
  var BASE_URL = '<?= base_url(); ?>';

  $(function() {
    setInterval(timestamp, 1000);
  });

  function timestamp(){
    $.ajax({
      url: BASE_URL + 'main/time',
      success: function(data){
        $('#timestamp').html(data);
      }
    });
  }
</script>