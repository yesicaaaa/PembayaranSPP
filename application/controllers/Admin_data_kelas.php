<?php  
defined('BASEPATH') or exit ('No direct access script allowed');

class Admin_data_kelas extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'am');
  }

  public function index()
  {
    $data = [
      'user'  => $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Data Kelas | SMK BPI',
      'css'   => 'assets/css/side-navbar.css',
      'js'    => ''
    ];

    if($this->input->post('submit')){
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin_data_kelas/index/';
    $this->db->like('kompetensi_keahlian', $data['keyword']);
    $this->db->from('kelas');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['kelas'] = $this->am->getDataKelas($config['per_page'], $start, $data['keyword']);

    if(!$this->input->post('submit')){
      $this->form_validation->set_rules('nama_kelas', 'Tingkat Kelas', 'required');
      $this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required');
    }

    if($this->form_validation->run() == false){
      $this->load->view('templates_admin/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-kelas', $data);
      $this->load->view('templates_admin/footer', $data);
    } else {
      $this->am->addDataKelas();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Kelas baru berhasil ditambahkan!</div>');
      redirect('admin_data_kelas');
    }
  }

  public function deleteDataKelas($id)
  {
    $this->am->deleteDataKelas($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Kelas berhasil dihapus!</div>');
    redirect('admin_data_kelas');
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
    $config['base_url'] = 'http://localhost/pembayaranSPP/admin_data_kelas/index/';
    $this->db->like('kompetensi_keahlian', $data['keyword']);
    $this->db->from('kelas');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['kelas'] = $this->am->getDataKelas($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('nama_kelas', 'Tingkat Kelas', 'required');
      $this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates_admin/header', $data);
      $this->load->view('templates_admin/side-navbar', $data);
      $this->load->view('admin/data-kelas', $data);
      $this->load->view('templates_admin/footer', $data);
    } else {
      $this->am->editDataKelas();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Kelas berhasil diubah!</div>');
      redirect('admin_data_kelas');
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin_data_kelas');
  }
}