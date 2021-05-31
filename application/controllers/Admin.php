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
      $this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required');
      $this->form_validation->set_rules('bulan_dibayar', 'Bulan Dibayar', 'required');
      $this->form_validation->set_rules('tahun_dibayar', 'Tahun Dibayar', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/transaksi-pembayaran', $data);
      $this->load->view('templates/footer');
    } else {
      $nisn = $this->input->post('nisn');
      $bulan_dibayar = $this->input->post('bulan_dibayar');
      $tahun_dibayar = $this->input->post('tahun_dibayar');
      $pembayaran = $this->db->get_where('pembayaran', ['nisn' => $nisn, 'bulan_dibayar' => $bulan_dibayar, 'tahun_dibayar' => $tahun_dibayar])->num_rows();

      $id_spp = $this->input->post('id_spp');
      $tahunspp = $this->db->get_where('spp', ['id_spp' => $id_spp])->row_array();

      if ($pembayaran > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
            role="alert">Transaksi pembayaran tersebut sudah pernah dibayarkan!</div>');
        redirect('admin/transaksi_pembayaran');
      } else if($tahun_dibayar == $tahunspp['tahun'] || $tahun_dibayar == $tahunspp['tahun'] + 1 || $tahun_dibayar == $tahunspp['tahun'] + 2 ) {
        $this->am->transaksiPembayaran();
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
              role="alert">Transaksi Pembayaran SPP Berhasil!</div>');
        redirect('admin/transaksi_pembayaran');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
            role="alert">Transaksi pembayaran gagal! Tahun dibayar tidak berlaku!</div>');
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
  public function laporansiswa($nisn)
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'siswa' => $this->db->get_where('siswa', ['nisn' => $nisn])->row_array(),
      'title' => 'Laporan Siswa | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    $siswa = $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    $tahunspp = $this->db->get_where('spp', ['id_spp' => $siswa['id_spp']])->row_array();

    for ($tahun = $tahunspp['tahun']; $tahun <= $tahunspp['tahun'] + 2; $tahun++) {
      $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
      foreach ($bulan as $b) {
        $cekPembayaran = $this->am->checkPembayaran($siswa['nisn'], $b, $tahun);
        if ($cekPembayaran > 0) {
          $status = 'Lunas';
        } else {
          $status = 'Belum Lunas';
        }
        $dataSiswa[] = array(
          'bulan' => $b,
          'tahun' => $tahun,
          'status'  => $status
        );
      }
    }

    $data['laporanSiswa'] = $dataSiswa;

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/laporan-siswa', $data);
    $this->load->view('templates/footer');
  }

  public function catatan_database()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Catatan Database | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['catatan'] = $this->am->getLogPetugas($data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/catatan-database', $data);
    $this->load->view('templates/footer');
  }

  public function refreshLog()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/catatan_database');
  }

  public function dashboard()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Dashboard | SMK BPI Bandung',
      'css'   => 'assets/css/side-navbar.css',
      'result'  => $this->am->siswa_kelas_res()
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_admin/side-navbar', $data);
    $this->load->view('admin/dashboard.php', $data);
    $this->load->view('templates/footer');
  }
}
