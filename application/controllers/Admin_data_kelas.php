<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Admin_data_kelas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'am');
    is_logged_in();

    $this->session->unset_userdata('keyword');
  }

  public function index()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Data Kelas | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['kelas'] = $this->am->getDataKelas($data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('nama_kelas', 'Tingkat Kelas', 'required');
      $this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-kelas', $data);
      $this->load->view('templates/footer');
    } else {
      $namakelas = $this->input->post('nama_kelas');
      $kompetensikeahlian = $this->input->post('kompetensi_keahlian');
      $kelas = $this->db->get_where('kelas', ['nama_kelas' => $namakelas, 'kompetensi_keahlian' => $kompetensikeahlian])->num_rows();

      if($kelas > 0){
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
          role="alert">Tambah kelas gagal! Kelas sudah tersedia</div>');
        redirect('admin_data_kelas');
      } else {
        $this->am->addDataKelas();
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Kelas baru berhasil ditambahkan!</div>');
        redirect('admin_data_kelas');
      }
    }
  }

  public function deleteDataKelas($id_kelas)
  {
    $siswaKelas = $this->db->get_where('siswa', ['id_kelas' => $id_kelas])->num_rows();

    if ($siswaKelas == 0) {
      $this->am->deleteDataKelas($id_kelas);
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Kelas berhasil dihapus!</div>');
      redirect('admin_data_kelas');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" 
            role="alert">Kelas terpakai! Tidak bisa dihapus.</div>');
      redirect('admin_data_kelas');
    }
  }

  public function getKelasRow()
  {
    $id_kelas = $this->input->post('id_kelas');
    $row = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row_array();

    echo json_encode($row);
  }

  public function editDataKelas()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Data Kelas | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['kelas'] = $this->am->getDataKelas($data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('nama_kelas', 'Tingkat Kelas', 'required');
      $this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-kelas', $data);
      $this->load->view('templates/footer');
    } else {
      $namakelas = $this->input->post('nama_kelas');
      $kompetensikeahlian = $this->input->post('kompetensi_keahlian');
      $kelas = $this->db->get_where('kelas', ['nama_kelas' => $namakelas, 'kompetensi_keahlian' => $kompetensikeahlian])->num_rows();
      
      if($kelas > 0){
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
          role="alert">Tambah kelas gagal! Kelas sudah tersedia.</div>');
        redirect('admin_data_kelas');
      } else {
        $this->am->editDataKelas();
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Kelas berhasil diubah!</div>');
        redirect('admin_data_kelas');
      }
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin_data_kelas');
  }
}
