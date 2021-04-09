<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-user mr-2"></i>Profile Saya</a></li>
    </ol>
  </nav>
  <div class="profileuser">
    <div class="row">
      <div class="col-md-3">
        <img src="<?= base_url('assets/userImage/') .  $user['gambar']; ?>" class="user-image">
      </div>
      <div class="col-md-3 namauser">
        <h6>Nama Lengkap</h6>
        <p><?= $user['nama_petugas'] ?></p>
        <h6>Email</h6>
        <p><?= $user['email'] ?></p>
        <h6>No. Telepon</h6>
        <p><?= $user['no_telp'] ?></p>
      </div>
      <div class="col-md-3">
        <h6>Alamat</h6>
        <p><?= $user['alamat'] ?></p>
        <h6>Posisi Jabatan</h6>
        <p><?= $user['level'] ?></p>
      </div>
    </div>
  </div>
</div>