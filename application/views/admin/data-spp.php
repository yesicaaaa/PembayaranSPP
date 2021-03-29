<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data SPP</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin_data_spp') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari Nominal SPP..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin_data_spp/refresh"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <?= form_error('tahun', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('nominal', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <a href="" class="btn btn-add" data-toggle="modal" data-target="#tambahDataSpp"><i class="fa fa-fw fa-user-plus"></i> Tambah Data SPP</a>
  <h6>Hasil : <?= $total_rows ?></h6>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tahun</th>
        <th scope="col">Nominal SPP</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($spp)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php foreach ($spp as $s) : ?>
        <tr>
          <th scope="row"><?= ++$start ?></th>
          <td><?= $s['tahun'] ?></td>
          <td>Rp<?= number_format($s['nominal'], 0, ',', '.'); ?></td>
          <td>
            <a href="javascript:getData(<?= $s['id_spp'] ?>);" class="badge badge-edit">Edit</a>
            <a href="<?= base_url(); ?>admin_data_spp/deleteDataSpp/<?= $s['id_spp']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->pagination->create_links(); ?>
</div>




<!-- modal tambah spp -->
<div class="modal fade" id="tambahDataSpp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data SPP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin_data_spp'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <select name="tahun" id="tahun" class="form-control">
              <option>Pilih Tahun</option>
              <?php for ($tahun = 2008; $tahun <= date('Y'); $tahun++) : ?>
                <option value="<?= $tahun; ?>"><?= $tahun; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal SPP">
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


<!-- modal edit Spp -->
<div class="modal fade" id="editDataSpp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data SPP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin_data_spp/editDataSpp'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="id_sppEdit" name="id_spp">
          <div class="form-group">
            <select name="tahun" id="tahunEdit" class="form-control">
              <option>Pilih Tahun</option>
              <?php for ($tahun = 2008; $tahun <= date('Y'); $tahun++) : ?>
                <option value="<?= $tahun; ?>"><?= $tahun; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nominalEdit" name="nominal">
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

  function getData(id_spp) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'admin_data_spp/getSppRow',
      data: {
        id_spp: id_spp
      },
      success: function(data) {
        $('#id_sppEdit').val(data.id_spp),
          $('#tahunEdit').val(data.tahun),
          $('#nominalEdit').val(data.nominal),
          $('#editDataSpp').modal()
      }
    });
  }
</script>