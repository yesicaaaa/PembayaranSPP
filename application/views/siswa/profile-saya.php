<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-user mr-2"></i>Profile Saya</a></li>
    </ol>
  </nav>
  <img src="<?= base_url('assets/img/') .  $user['gambar']; ?>" class="user-image">
  <div class="petugas-info">
    <h6>NISN</h6>
    <p><?= $user['nisn'] ?></p>
    <h6>NIS</h6>
    <p><?= $user['nis'] ?></p>
    <h6>Nama Lengkap</h6>
    <p><?= $user['nama'] ?></p>
    <h6>Email</h6>
    <p><?= $user['email'] ?></p>
    <h6>Kelas</h6>
    <p><?= $kelas['nama_kelas'] ?> <?= $kelas['kompetensi_keahlian'] ?></p>
    <h6>Alamat</h6>
    <p><?= $user['alamat'] ?></p>
    <h6>No. Telepon</h6>
    <p><?= $user['no_telp'] ?></p>
    <h6>SPP/Bulan</h6>
    <p><?= number_format($spp['nominal'], 0, ',', '.') ?></p>
  </div>
</div>