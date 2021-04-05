<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Transaksi Pembayaran</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin/transaksi_pembayaran') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari Nama Siswa..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refreshTP"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <?= form_error('id_petugas', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('nisn', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('id_kelas', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('bulan_dibayar', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('tahun_dibayar', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('id_spp', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('jumlah_bayar', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <h5 class="laporanbulan">Pencarian untuk <span>
  <?php if(!$this->session->keyword) : ?>
  semua siswa 
  <?php else : ?>
  <?= $this->session->keyword ?>
  <?php endif; ?>
  </span></h5>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">NISN</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Kelas</th>
        <th scope="col">Bayar SPP</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($siswa)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php $i = 1 ?>
      <?php foreach ($siswa as $sw) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $sw['nisn'] ?></td>
          <td><?= $sw['nama'] ?></td>
          <td><?= $sw['nama_kelas'] ?> <?= $sw['kompetensi_keahlian'] ?></td>
          <td>
            <a href="javascript:getData('<?= $sw['nisn']; ?>');" class="badge badge-edit">Bayar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>




<!-- modal Transaksi Pembayaran -->
<div class="modal fade" id="transaksiSpp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pembayaran SPP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/transaksi_pembayaran'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <select name="id_petugas" id="petugas" class="form-control">
              <option>Nama Petugas</option>
              <?php foreach ($petugas as $pg) : ?>
                <option value="<?= $pg['id_petugas']; ?>"><?= $pg['nama_petugas']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nisnDisable" disabled>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="nisn" name="nisn">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" disabled>
          </div>
          <div class="form-group input-group">
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" disabled>
            <input type="text" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" disabled>
          </div>
          <div class="form-group input-group">
            <select name="bulan_dibayar" id="bulan_dibayar" class="form-control">
              <option>Bulan</option>
              <?php
              $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
              $jml_bulan = count($bulan);
              for ($i = 0; $i < $jml_bulan; $i++) : ?>
                <option value="<?= $bulan[$i]; ?>"><?= $bulan[$i]; ?></option>
              <?php endfor; ?>
            </select>
            <select name="tahun_dibayar" id="tahun_dibayar" class="form-control">
              <option>Tahun</option>
              <?php for ($i = 2021; $i <= date('Y'); $i++) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="id_sppDisable" disabled>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_spp" name="id_spp">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Total Bayar">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" placeholder="Tanggal Bayar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Bayar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var BASE_URL = '<?= base_url(); ?>';

  function getData(nisn) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'admin/getSiswaSppRow',
      data: {
        nisn: nisn
      },
      success: function(data) {
        $('#nisnDisable').val(data.nisn),
          $('#nisn').val(data.nisn),
          $('#nama').val(data.nama),
          $('#nama_kelas').val(data.nama_kelas),
          $('#kompetensi_keahlian').val(data.kompetensi_keahlian),
          $('#id_sppDisable').val(data.nominal),
          $('#id_spp').val(data.id_spp),
          $('#transaksiSpp').modal()
      }
    });
  }
</script>