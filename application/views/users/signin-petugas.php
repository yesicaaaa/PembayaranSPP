<div class="container">
  <h2>Signin Petugas</h2>
  <h4>SMK BPI</h4>
  <?= $this->session->flashdata('message'); ?>
  <form action="<?= base_url('signin/signin_petugas'); ?>" method="POST">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
        </div>
        <input type="email" class="form-control" placeholder="Email" name="email"><br>
      </div>
      <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-key" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="Password" name="password"><br>
      </div>
      <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <a id="pass" class="forgotpass" href="<?= base_url('signin/forgot_password_petugas'); ?>">Lupa password?</a>
    <button type="submit" class="btn">Sign in</button>
    <a class="back" href="<?= base_url(); ?>main">Kembali</a>
  </form>
</div>