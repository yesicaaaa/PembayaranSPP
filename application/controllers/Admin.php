<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'am');
    is_logged_in();

    $this->session->unset_userdata('keyword');
  }

  public function transaksi_pembayaran()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'spp'   => $this->db->get('spp')->result_array(),
      'kelas' => $this->db->get('kelas')->result_array(),
      'petugas' => $this->db->get('petugas')->result_array(),
      'pembayaran'  => $this->db->get('pembayaran')->result_array(),
      'title' => 'Transaksi Pembayaran | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['siswa'] = $this->am->getDataSiswaSpp($data['keyword']);

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
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/transaksi-pembayaran', $data);
      $this->load->view('templates/footer');
    } else {
      $bulan_dibayar = $this->input->post('bulan_dibayar');
      $tahun_dibayar = $this->input->post('tahun_dibayar');
      $nisn = $this->input->post('nisn');
      $pembayaran = $this->db->get_where('pembayaran', ['nisn' => $nisn, 'bulan_dibayar' => $bulan_dibayar, 'tahun_dibayar' => $tahun_dibayar])->num_rows();

      if ($pembayaran > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
            role="alert">Transaksi pembayaran tersebut sudah pernah dibayarkan!</div>');
        redirect('admin/transaksi_pembayaran');
      } else {
        $this->am->transaksiPembayaran();
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Transaksi Pembayaran SPP Berhasil!</div>');
        redirect('admin/transaksi_pembayaran');
      }
    }
  }

  public function getSiswaSppRow()
  {
    $nisn = $this->input->post('nisn');
    $row  = $this->am->getSiswaSppRow($nisn);

    echo json_encode($row);
  }

  public function refreshTP()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/transaksi_pembayaran');
  }

  public function my_profile()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Profile Saya | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/profile-saya', $data);
    $this->load->view('templates/footer');
  }

  public function history_pembayaran()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'History Pembayaran | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['history'] = $this->am->getHistoryPembayaran($data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/history-pembayaran', $data);
    $this->load->view('templates/footer');
  }

  public function refreshHP()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/history_pembayaran');
  }

  //LAPORAN
  public function laporan()
  {
    $datatemplate = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Laporan | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $siswa = $this->am->getSiswaLaporan($data['keyword']);
    $dataSiswa = array();

    foreach ($siswa as $s) {
      $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
      $jml_bulan = count($bulan);
      for ($i = 0; $i < $jml_bulan; $i++) {
        for($tahun = 2021; $tahun<=date('Y'); $tahun++){
          $checkPembayaran  = $this->am->checkPembayaran($s['nisn'], $bulan[$i], $tahun);
          if($checkPembayaran == 1){
            $status = 'Lunas';
          } else {
            $status = 'Belum Lunas';
          }
          $dataSiswa[] = array(
            'nisn'  => $s['nisn'],
            'nama'  => $s['nama'],
            'bulan' => $bulan[$i],
            'tahun' => $tahun,
            'status'  => $status
          );
        }
      }
    }

    $data['siswa'] = $dataSiswa;

    $this->load->view('templates/header', $datatemplate);
    $this->load->view('templates_admin/side-navbar', $datatemplate);
    $this->load->view('admin/laporan', $data);
    $this->load->view('templates/footer');
  }

  public function refreshLP()
  {
    $this->session->unset_userdata('keyword');
    $this->session->unset_userdata('keyword2');
    redirect('admin/laporan');
  }

  public function catatan_database()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'catatan' => $this->am->getLogPetugas(),
      'title' => 'Catatan Database | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/catatan-database', $data);
    $this->load->view('templates/footer');
  }
}
