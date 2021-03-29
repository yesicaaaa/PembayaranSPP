<div class="container">
  <h2>SMK BPI</h2>
  <?= $this->session->flashdata('message'); ?>
  <form action="<?= base_url('signin/forgot_password_petugas'); ?>" method="POST">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
        </div>
        <input type="email" class="form-control" placeholder="Email" name="email"><br>
      </div>
      <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <button type="submit" class="btn">Reset Password</button>
    <a class="back" href="<?= base_url(); ?>signin/signin_petugas">Kembali</a>
  </form>
</div>