<div class="container">
  <h2>Change Password</h2>
  <h6 class="changepass">for <span><?= $this->session->userdata('reset_email') ?></span></h6>
  <form action="<?= base_url('signin/change_password_siswa'); ?>" method="POST">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-key" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="New Password" name="password1"><br>
      </div>
      <?= form_error('password1', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-key" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="Confirm New Password" name="password2"><br>
      </div>
      <?= form_error('password2', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-change">Change Password</button>
  </form>
</div>