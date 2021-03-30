<?php  

function is_logged_in()
{
  $ci = get_instance(); //memanggil library ci
  if(!$ci->session->userdata('email')){
    redirect('main');
  } else {
    $level = $ci->session->userdata('level');
    $access = $ci->db->get_where('petugas', ['level' => $level])->row_array();

    if($access['level'] != 'Admin' && $access['level'] != 'Petugas'){
      redirect('main/blocked_siswa');
    }else if($access['level'] != 'Admin'){
      redirect('main/blocked_petugas');
    }
  }
}

function is_logged_in_petugas()
{
  $ci = get_instance();
  if(!$ci->session->userdata('email')){
    redirect('main');
  } else {
    $level = $ci->session->userdata('level');
    $access = $ci->db->get_where('petugas', ['level' => $level])->row_array();

    if($access['level'] != 'Petugas'){
      redirect('main/blocked_siswa');
    }
  }
}

function is_logged_in_siswa()
{
  $ci = get_instance();
  if (!$ci->session->userdata('email')) {
    redirect('main');
  }
}