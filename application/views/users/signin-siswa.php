<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?= base_url() . $css; ?>">
  <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/lg1.png">
  <title><?= $title ?></title>

</head>

<body>

  <div class="container">
    <h2>SMK BPI</h2>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('signin/signin_siswa'); ?>" method="POST">
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
      <a id="pass" class="forgotpass" href="<?= base_url(); ?>signup/forgotPassword">Forgot password?</a>
      <button type="submit" class="btn">Sign in</button>  
    <a class="back" href="<?= base_url(); ?>main">Kembali</a>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?= base_url() . $js; ?>"></script>
</body>