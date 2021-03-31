<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('petugas_model', 'pm');
    is_logged_in_petugas();
  }

  public function transaksi_pembayaran()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'spp'   => $this->db->get('spp')->result_array(),
      'kelas' => $this->db->get('kelas')->result_array(),
      'petugas' => $this->db->get('petugas')->result_array(),
      'title' => 'Transaksi Pembayaran | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin/transaksi_pembayaran/index';
    $this->db->like('nama', $data['keyword']);
    $this->db->from('siswa');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['siswa'] = $this->pm->getDataSiswaSpp($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('id_petugas', 'Nama Petugas', 'required');
      $this->form_validation->set_rules('nisn', 'NISN Siswa', 'required');
      $this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required');
      $this->form_validation->set_rules('bulan_dibayar', 'Bulan Dibayar', 'required');
      $this->form_validation->set_rules('tahun_dibayar', 'Tahun Dibayar', 'required');
      $this->form_validation->set_rules('id_spp', 'Jenis SPP', 'required');
      $this->form_validation->set_rules('jumlah_bayar', 'Total Bayar', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_petugas/side-navbar', $data);
      $this->load->view('petugas/transaksi-pembayaran', $data);
      $this->load->view('templates/footer');
    } else {
      $this->pm->transaksiPembayaran();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Transaksi Pembayaran SPP Berhasil!</div>');
      redirect('petugas/transaksi_pembayaran');
    }
  }

  public function getSiswaSppRow()
  {
    $nisn = $this->input->post('nisn');
    $row  = $this->pm->getSiswaSppRow($nisn);

    echo json_encode($row);
  }

  public function refreshTP()
  {
    $this->session->unset_userdata('keyword');
    redirect('petugas/transaksi_pembayaran');
  }

  public function my_profile()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Profile Saya | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_petugas/side-navbar', $data);
    $this->load->view('petugas/profile-saya', $data);
    $this->load->view('templates/footer');
  }

  public function history_pembayaran()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'History Pembayaran | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if($this->input->post('submit')){
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/petugas/history_pembayaran';
    $this->db->like('nisn', $data['keyword']);
    $this->db->from('pembayaran');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['history'] = $this->pm->getDataHistory($config['per_page'], $start, $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates_petugas/side-navbar.php', $data);
    $this->load->view('petugas/history-pembayaran', $data);
    $this->load->view('templates/footer');
  }

  public function refreshHP()
  {
    $this->session->unset_userdata('keyword');
    redirect('petugas/history_pembayaran');
  }
}
