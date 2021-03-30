<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Admin_data_spp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'am');
    is_logged_in();
  }

  public function index()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'siswa' => $this->am->getSppSiswa(),
      'title' => 'Data SPP | SMK BPI',
      'css'   => 'assets/css/side-navbar.css',
      'js'    => ''
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin_data_spp/index';
    $this->db->like('nominal', $data['keyword']);
    $this->db->from('spp');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start']) ? $data['start'] : 0;
    $data['spp'] = $this->am->getDataSpp($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('tahun', 'Tahun', 'required');
      $this->form_validation->set_rules('nominal', 'Nominal SPP', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-spp', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->addDataSpp();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Data SPP berhasil ditambahkan!</div>');
      redirect('admin_data_spp');
    }
  }

  public function deleteDataSpp($id_spp)
  {
    $this->am->deleteDataSpp($id_spp);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Data SPP berhasil dihapus!</div>');
    redirect('admin_data_spp');
  }

  public function getSppRow()
  {
    $id_spp = $this->input->post('id_spp');
    $row = $this->db->get_where('spp', ['id_spp' => $id_spp])->row_array();

    echo json_encode($row);
  }

  public function editDataSpp()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Data SPP | SMK BPI',
      'css'   => 'assets/css/side-navbar.css',
      'js'    => ''
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin_data_spp/index';
    $this->db->like('nominal', $data['keyword']);
    $this->db->from('spp');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start']) ? $data['start'] : 0;
    $data['spp'] = $this->am->getDataSpp($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('tahun', 'Tahun', 'required');
      $this->form_validation->set_rules('nominal', 'Nominal SPP', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-spp', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->editDataSpp();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Data SPP berhasil diubah!</div>');
      redirect('admin_data_spp');
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin_data_spp');
  }
}
