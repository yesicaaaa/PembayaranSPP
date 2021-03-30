<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('signin_model', 'sm');
  }
  public function signin_petugas()
  {
    $data = [
      'title' => 'Signin | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/signin-petugas');
      $this->load->view('templates/footer', $data);
    } else {
      $this->_signin_petugas();
    }
  }

  private function _signin_petugas()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->db->get_where('petugas', ['email' => $email])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $data = [
          'email' => $user['email'],
          'level' => $user['level'],
          'nama'  => $user['nama_petugas'],
          'gambar'   => $user['gambar']
        ];
        $this->session->set_userdata($data);
          if ($user['level'] == 'Admin') {
            redirect('admin_data_petugas');
          } else {
            redirect('petugas/transaksi_pembayaran');
          }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
        redirect('signin/signin_petugas');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diregistrasi!</div>');
      redirect('signin/signin_petugas');
    }
  }

  public function signin_siswa()
  {
    $data = [
      'title' => 'Signin | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/signin-siswa');
      $this->load->view('templates/footer', $data);
    } else {
      $this->_signin_siswa();
    }
  }

  private function _signin_siswa()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->db->get_where('siswa', ['email' => $email])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $data = [
          'email' => $user['email'],
          'nama'  => $user['nama'],
          'gambar'   => $user['gambar'],
          'id_spp'  => $user['id_spp'],
          'id_kelas'  => $user['id_kelas'],
          'nisn'  => $user['nisn']
        ];
        $this->session->set_userdata($data);
        redirect('siswa');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
        redirect('signin/signin_siswa');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diregistrasi!</div>');
      redirect('signin/signin_siswa');
    }
  }

  public function forgot_password_petugas()
  {
    $data = [
      'title' => 'Forgot Password | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

    if($this->form_validation->run() ==  false){
      $this->load->view('templates/header', $data);
      $this->load->view('users/forgot-password-petugas');
      $this->load->view('templates/footer', $data);
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('petugas', ['email' => $email])->row_array();

      if($user){
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created'  => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email Anda untuk reset password!</div>');
        redirect('signin/signin_petugas');
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diregistrasi!</div>');
        redirect('signin/signin_petugas');
      }
    }
  }

  private function _sendEmail($token)
  {
    $config = [
      'protocol'  => 'smtp', //simple mail transfer protocol
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'dalhaneul.s@gmail.com',
      'smtp_pass' => 'seo555554444',
      'smtp_port' => 465, //port smtp google
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('bdg.smkbpi@gmail.com', 'SMK BPI Bandung');
    $this->email->to($this->input->post('email'));

    $this->email->subject('Reset Password');
    $this->email->message('Klik link ini untuk mereset password Anda : <a href="'. base_url() . 'signin/reset_password_petugas?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');

    if($this->email->send()){
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function reset_password_petugas()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('petugas', ['email' => $email])->row_array();

    if($user){
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if($user_token){
        if(time() - $user_token['date_created'] < (60 * 60 * 24)){
          $this->session->set_userdata('reset_email', $email);
          $this->change_password_petugas();
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password gagal! Token kadaluarsa!</div>');
          redirect('signin/signin_petugas');
        }
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
        redirect('signin/signin_petugas');
      }
    }else{
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email tidak terdaftar.</div>');
      redirect('signin/signin_petugas');
    }
  }

  public function change_password_petugas()
  {
    if(!$this->session->userdata('reset_email')){
      redirect('signin/signin_petugas');
    }

    $data = [
      'title' => 'Change Password | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[6]|matches[password1]');

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('users/change-password-petugas');
      $this->load->view('templates/footer', $data);
    } else {
      $password = htmlspecialchars(password_hash($this->input->post('password1'), PASSWORD_DEFAULT));
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('petugas');

      $this->session->unset_userdata('reset_email');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Signin sekarang.</div>');
      redirect('signin/signin_petugas');
    }
  }


  //forgot password siswa
  public function forgot_password_siswa()
  {
    $data = [
      'title' => 'Forgot Password | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

    if ($this->form_validation->run() ==  false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/forgot-password-siswa');
      $this->load->view('templates/footer', $data);
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('siswa', ['email' => $email])->row_array();

      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created'  => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmailSiswa($token);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email Anda untuk reset password!</div>');
        redirect('signin/signin_siswa');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diregistrasi!</div>');
        redirect('signin/signin_siswa');
      }
    }
  }

  private function _sendEmailSiswa($token)
  {
    $config = [
      'protocol'  => 'smtp', //simple mail transfer protocol
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'dalhaneul.s@gmail.com',
      'smtp_pass' => 'seo555554444',
      'smtp_port' => 465, //port smtp google
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('bdg.smkbpi@gmail.com', 'SMK BPI Bandung');
    $this->email->to($this->input->post('email'));

    $this->email->subject('Reset Password');
    $this->email->message('Klik link ini untuk mereset password Anda : <a href="' . base_url() . 'signin/reset_password_siswa?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function reset_password_siswa()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('siswa', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->session->set_userdata('reset_email', $email);
          $this->change_password_siswa();
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password gagal! Token kadaluarsa!</div>');
          redirect('signin/signin_siswa');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
        redirect('signin/signin_siswa');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email tidak terdaftar.</div>');
      redirect('signin/signin_siswa');
    }
  }

  public function change_password_siswa()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('signin/signin_siswa');
    }

    $data = [
      'title' => 'Change Password | SMK BPI Bandung',
      'css'   => 'assets/css/signin.css',
      'js'    => ''
    ];

    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[6]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/change-password-siswa');
      $this->load->view('templates/footer', $data);
    } else {
      $password = htmlspecialchars(password_hash($this->input->post('password1'), PASSWORD_DEFAULT));
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('siswa');

      $this->session->unset_userdata('reset_email');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Signin sekarang.</div>');
      redirect('signin/signin_siswa');
    }
  }
}
