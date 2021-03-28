<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_data_petugas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'am');
  }
  
  public function index()
  {
    $data  = [
      'user'    => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title'   => 'Data Petugas | SMK BPI',
      'css'     => 'assets/css/side-navbar.css',
      'js'      => ''
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin/index';
    $this->db->like('nama_petugas', $data['keyword']);
    $this->db->from('petugas');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['petugas'] = $this->am->getPetugas($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('level', 'Posisi', 'required');
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password1]');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates_admin/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-petugas', $data);
      $this->load->view('templates_admin/footer', $data);
    } else {
      $this->am->addPetugas();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Petugas baru berhasil ditambahkan!</div>');
      redirect('admin_data_petugas');
    }
  }

  public function deletePetugas($id)
  {
    $this->am->deletePetugas($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Petugas berhasil dihapus!</div>');
    redirect('admin_data_petugas');
  }

  public function getPetugasRow()
  {
    $id_petugas = $this->input->post('id_petugas');
    $row = $this->db->where('id_petugas', $id_petugas)->get('petugas')->row_array();
    echo json_encode($row);
  }

  public function editPetugas()
  {
    $data  = [
      'user'    => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title'   => 'Data Petugas | SMK BPI',
      'css'     => 'assets/css/side-navbar.css',
      'js'      => ''
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/index/';
    $this->db->like('nama_petugas', $data['keyword']);
    $this->db->from('petugas');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['petugas'] = $this->am->getPetugas($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('level', 'Posisi', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates_admin/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-petugas', $data);
      $this->load->view('templates_admin/footer', $data);
    } else {
      $this->am->editPetugas();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Petugas berhasil diubah!</div>');
      redirect('admin_data_petugas');
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin_data_petugas');
  }
}
