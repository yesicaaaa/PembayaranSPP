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
      $this->load->view('users/signin-petugas', $data);
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
          'level' => $user['level']
        ];
        $this->session->set_userdata($data);
        if ($user['level'] == 'Admin') {
          redirect('admin');
        } else {
          redirect('petugas');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
        redirect('signin/signin_petugas');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
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
      $this->load->view('users/signin-siswa', $data);
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
          'level' => $user['level']
        ];
        $this->session->set_userdata($data);
        redirect('siswa/history-pembayaran');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
        redirect('signin/signin_siswa');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
      redirect('signin/signin_siswa');
    }
  }
}
