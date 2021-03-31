<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin_data_kelas') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari Kompetensi Keahlian..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin_data_kelas/refresh"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <?= form_error('nama_kelas', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('kompetensi_keahlian', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-add" data-toggle="modal" data-target="#tambahKelas"><i class="fa fa-fw fa-user-plus"></i> Tambah Kelas Baru</a>
  <h6>Hasil : <?= $total_rows ?></h6>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tingkat Kelas</th>
        <th scope="col">Kompetensi Keahlian</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($kelas)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php foreach ($kelas as $kl) : ?>
        <tr>
          <th scope="row"><?= ++$start ?></th>
          <td><?= $kl['nama_kelas'] ?></td>
          <td><?= $kl['kompetensi_keahlian'] ?></td>
          <td>
            <a href="javascript:getData(<?= $kl['id_kelas'] ?>);" class="badge badge-edit">Edit</a>
            <a href="<?= base_url(); ?>admin_data_kelas/deleteDataKelas/<?= $kl['id_kelas']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->pagination->create_links(); ?>
</div>




<!-- modal tambah kelas -->
<div class="modal fade" id="tambahKelas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin_data_kelas'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Tingkat Kelas">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" placeholder="Kompetensi Keahlian">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- modal edit kelas -->
<div class="modal fade" id="editKelas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin_data_kelas/editDataKelas'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="id_kelasEdit" name="id_kelas">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_kelasEdit" name="nama_kelas">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="kompetensi_keahlianEdit" name="kompetensi_keahlian">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var BASE_URL = '<?= base_url(); ?>';

  function getData(id_kelas) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'admin_data_kelas/getKelasRow',
      data: {
        id_kelas: id_kelas
      },
      success: function(data) {
        $('#id_kelasEdit').val(data.id_kelas),
          $('#nama_kelasEdit').val(data.nama_kelas),
          $('#kompetensi_keahlianEdit').val(data.kompetensi_keahlian),
          $('#editKelas').modal()
      }
    });
  }
</script>