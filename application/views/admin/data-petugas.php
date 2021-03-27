<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Petugas</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari Nama Petugas..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refresh"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <?= form_error('nama_petugas', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('no_telp', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('alamat', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('level', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-add" data-toggle="modal" data-target="#tambahPetugas"><i class="fa fa-fw fa-user-plus"></i> Tambah Petugas</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Petugas</th>
        <th scope="col">Email</th>
        <th scope="col">No. Telepon</th>
        <th scope="col">Alamat</th>
        <th scope="col">Posisi</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($petugas)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php foreach ($petugas as $pt) : ?>
        <tr>
          <th scope="row"><?= ++$start ?></th>
          <td><?= $pt['nama_petugas'] ?></td>
          <td><?= $pt['email'] ?></td>
          <td><?= $pt['no_telp'] ?></td>
          <td><?= $pt['alamat'] ?></td>
          <td><?= $pt['level'] ?></td>
          <td>
            <a href="javascript:getData(<?= $pt['id_petugas'] ?>);" class="badge badge-edit">Edit</a>
            <a href="<?= base_url(); ?>admin/deletePetugas/<?= $pt['id_petugas']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->pagination->create_links(); ?>
</div>




<!-- modal tambah petugas -->
<div class="modal fade" id="tambahPetugas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Petugas Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama Petugas">
          </div>
          <div class="form-group">
            <select name="level" id="level" class="form-control">
              <option>Select Menu</option>
              <?php foreach ($petugas as $pt) : ?>
                <option value="<?= $pt['level']; ?>"><?= $pt['level']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telepon">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
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


<!-- modal edit petugas -->
<div class="modal fade" id="editPetugas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/editPetugas'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="id_petugasEdit" name="id_petugas">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_petugasEdit" name="nama_petugas">
          </div>
          <div class="form-group">
            <select name="level" id="levelEdit" class="form-control">
              <option>Select Menu</option>
              <?php foreach ($petugas as $pt) : ?>
                <option value="<?= $pt['level']; ?>"><?= $pt['level']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="emailEdit" name="email">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" id="no_telpEdit" name="no_telp">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="alamatEdit" name="alamat">
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

  function getData(id_petugas) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'admin/getPetugasRow',
      data: {
        id_petugas: id_petugas
      },
      success: function(data) {
        $('#id_petugasEdit').val(data.id_petugas),
        $('#nama_petugasEdit').val(data.nama_petugas),
        $('#levelEdit').val(data.level),
        $('#emailEdit').val(data.email),
        $('#no_telpEdit').val(data.no_telp),
        $('#alamatEdit').val(data.alamat),
        $('#editPetugas').modal()
      }
    });
  }
</script>