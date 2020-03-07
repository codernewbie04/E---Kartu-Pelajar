<?php
class Users extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('masuk') !=TRUE){
      $url=base_url('login');
      redirect($url);
    };
    $this->load->model('m_setting', "setting");
    $this->load->model('m_users', "users");
    $this->load->model('m_murid', "murid");
    $this->load->library('upload');
  }

  public function index(){
    $x['setting'] = $this->setting->get_setting();
    $x['users']   = $this->users->getData();
    $username     = $this->session->userdata('username');
    $x['my_data']   = $this->users->getData($username);

    $this->load->view('templates/header',$x);
    $this->load->view('v_users');
    $this->load->view('templates/footer');
  }

  public function list_murid()
  {
    $x['setting'] = $this->setting->get_setting();
    $x['murid']   = $this->murid->getMurid();
    $x['kelas_list'] = $this->murid->get_all_kelas();
    $this->load->view('templates/header',$x);
    $this->load->view('v_murid');
    $this->load->view('templates/footer');
  }

  public function add_murid()
  {
    $config['upload_path'] = './assets/images/murid/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
    $this->upload->initialize($config);

    $nis       = $this->input->post('nis');
    $rfid_key  = $this->input->post('rfid_key');
    $nama      = $this->input->post('nama');
    $jenkel    = $this->input->post('jenkel');
    $alamat    = $this->input->post('alamat');
    $kelas     = $this->input->post('kelas');

    $this->form_validation->set_rules('nis', 'nis', 'required');
    $this->form_validation->set_rules('rfid_key', 'RFID Key', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[60]');
    $this->form_validation->set_rules('jenkel', 'Jenkel', 'required|trim');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');
    if ($this->form_validation->run() == false)
    {
      $this->session->set_flashdata('value_murid', $_POST);
      $error = str_replace(array("\n", "\r"), '', validation_errors());
      $this->session->set_flashdata('msg_murid', array("toast_type" => "error","msg" => str_replace(array("\n", "\r"), '<br>', $error)));
      redirect('users/list_murid');
    } else {
      if(empty($_FILES['filefoto']['name'])){
        $this->session->set_flashdata('value_murid', $_POST);
        $this->session->set_flashdata('msg_murid', array("toast_type" => "error","msg" => "Foto tidak ditemukan"));
        redirect('users/list_murid');
      } else {
        $this->upload->do_upload('filefoto');
        $gbr = $this->upload->data();
        $gambar=$gbr['file_name'];
        //Compress Image
        $config['image_library']='gd2';
        $config['source_image']='./assets/images/murid/'.$gbr['file_name'];
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '60%';
        $config['width']= 300;
        $config['height']= 300;
        $config['new_image']= './assets/images/murid/'.$gbr['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $data = array(
          'nis' => $nis,
          'rfid_key' => $rfid_key,
          'nama' => $nama,
          'jenkel' => $jenkel,
          'kelas_id' => $kelas,
          'alamat' => $alamat,
          'joindate' => date("Y-m-d H:i:s"),
          'saldo'=>0,
          'photo' => $gambar
        );
        $this->murid->add_murid($data);
        $this->session->set_flashdata('msg_murid', array("toast_type" => "success","msg" => "Berhasil menambah murid baru"));
        redirect('users/list_murid');
      }
    }
  }
  public function edit_murid()
  {
    $id        = $this->input->post('id');
    $nis       = $this->input->post('nis');
    $nama      = $this->input->post('nama');
    $jenkel    = $this->input->post('jenkel');
    $kelas     = $this->input->post('kelas');

    $this->form_validation->set_rules('id', 'ID', 'required');
    $this->form_validation->set_rules('nis', 'NIS', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[60]');
    $this->form_validation->set_rules('jenkel', 'Jenkel', 'required|trim');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');

    if ($this->form_validation->run() == false){
      $this->session->set_flashdata('value_guru', $_POST);
      $error = str_replace(array("\n", "\r"), '', validation_errors());
      $this->session->set_flashdata('msg_murid', array("toast_type" => "error","msg" => str_replace(array("\n", "\r"), '<br>', $error)));
      redirect('users/list_murid');
    } else {
      $data = array(
        'nis' => $nis,
        'nama' => $nama,
        'jenkel' => $jenkel,
        'kelas_id' => $kelas
      );
      $this->murid->edit_murid($data, $id);
      $this->session->set_flashdata('msg_murid', array("toast_type" => "success","msg" => "Berhasil merubah data murid"));
      redirect('users/list_murid');
    }
  }

  public function hapus_murid()
  {
    $id = $this->input->post('id');
    if(!$id)
    {
      $this->session->set_flashdata('msg_murid', array("toast_type" => "error","msg" => "Terjadi kesalahan"));
      redirect('users/list_murid');
    } else {
      $this->db->delete('tbl_siswa', 'id='.$id);
      $this->session->set_flashdata('msg_murid', array("toast_type" => "success","msg" => "Berhasil mengapus data murid"));
      redirect('users/list_murid');
    }
  }

  public function add_user()
  {
    $config['upload_path'] = './assets/images/fp/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
    $this->upload->initialize($config);

    $nama     = $this->input->post('nama');
    $username =$this->input->post('username');
    $password =  $this->input->post('password');
    $email    = $this->input->post('email');
    $level    = $this->input->post('level');

    if(!empty($_FILES['filefoto']['name']))
    {
      $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[30]|is_unique[tbl_users.username]');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_users.email]');
      $this->form_validation->set_rules('level', 'Level', 'required|trim');
      if ($this->form_validation->run() == false)
      {
        $this->session->set_flashdata('value_users', $_POST);
        $error = str_replace(array("\n", "\r"), '', validation_errors());
        $this->session->set_flashdata('msg_users', array("toast_type" => "error","msg" => str_replace(array("\n", "\r"), '<br>', $error)));
        redirect('users');
      } else {
        $this->upload->do_upload('filefoto');
        $gbr = $this->upload->data();
        $gambar=$gbr['file_name'];
        //Compress Image
        $config['image_library']='gd2';
        $config['source_image']='./assets/images/fp/'.$gbr['file_name'];
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '60%';
        $config['width']= 300;
        $config['height']= 300;
        $config['new_image']= './assets/images/fp/'.$gbr['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $data = array(
          'username' => $username,
          'email' => $email,
          'nama' => $nama,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'photo' => $gambar,
          'level' => $level,
          'joindate' => date("Y-m-d H:i:s")
        );
        $this->users->add_user($data);
        $this->session->set_flashdata('msg_users', array("toast_type" => "success","msg" => "Berhasil menambah user baru"));
        redirect('users');
      }

    }else{
      $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[30]|is_unique[tbl_users.username]');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_users.email]');
      $this->form_validation->set_rules('level', 'Level', 'required|trim');
      if ($this->form_validation->run() == false)
      {
        $this->session->set_flashdata('value_users', $_POST);
        $error = str_replace(array("\n", "\r"), '', validation_errors());
        $this->session->set_flashdata('msg_users', array("toast_type" => "error","msg" => str_replace(array("\n", "\r"), '<br>', $error)));
        redirect('users');
      } else {
        $data = array(
          'username' => $username,
          'email' => $email,
          'nama' => $nama,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'photo' => "nopic.png",
          'level' => $level,
          'joindate' => date("Y-m-d H:i:s")
        );
        $this->users->add_user($data);
        $this->session->set_flashdata('msg_users', array("toast_type" => "success","msg" => "Berhasil menambah user baru"));
        redirect('users');
      }
    }
  }

  public function edit_user()
  {
    $id       = $this->input->post('id');
    $nama     = $this->input->post('nama');
    $email    = $this->input->post('email');
    $password = $this->input->post('password');
    $level    = $this->input->post('level');
    $kelas    = $this->input->post('kelas');


    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('level', 'Level', 'required|trim');
    $this->form_validation->set_rules('kelas', 'Level', 'required|trim');

    if ($this->form_validation->run() == false){
      $error = str_replace(array("\n", "\r"), '', validation_errors());
      $this->session->set_flashdata('msg_users', array("toast_type" => "error","msg" => str_replace(array("\n", "\r"), '<br>', $error)));
      redirect('users');
    } else {
      if(!$password){
        if($kelas !== "all"){
          $kelas_name = $this->db->get_where('tbl_kelas', 'id='.$kelas)->last_row('array')['kelas_nama'];
        } else {
          $kelas_name = "all";
        }
        $data = array(
          'email' => $email,
          'nama' => $nama,
          'kelas' => $kelas_name,
          'level' => $level
        );
        $this->users->update_user($data, $id);
        $this->session->set_flashdata('msg_users', array("toast_type" => "success","msg" => "Berhasil merubah data user"));
        redirect('users');
      } else {
        if($kelas !== "all"){
          $kelas_name = $this->db->get_where('tbl_kelas', 'id='.$kelas)->last_row('array')['kelas_nama'];
        } else {
          $kelas_name = "all";
        }
        $data = array(
          'email' => $email,
          'nama' => $nama,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'kelas' => $kelas_name,
          'level' => $level
        );
        $this->users->update_user($data, $id);
        $this->session->set_flashdata('msg_users', array("toast_type" => "success","msg" => "Berhasil merubah data user"));
        redirect('users');
      }
    }
  }

  public function hapus_users()
  {
    $id = $this->input->post('id');
    if(!$id){
      $this->session->set_flashdata('msg_users', array("toast_type" => "error","msg" => "Terjadi kesalahan ketika mengapus data!"));
      redirect('users');
    } else {
      $this->users->hapus_user($id);
      $this->session->set_flashdata('msg_users', array("toast_type" => "success","msg" => "Berhasil mengahpus user"));
      redirect('users');
    }
  }

  public function list_kelas()
  {
    $x['setting'] = $this->setting->get_setting();
    $x['kelas_list']   = $this->murid->get_all_kelas();
    $this->load->view('templates/header',$x);
    $this->load->view('v_listkelas');
    $this->load->view('templates/footer');
  }

  public function add_kelas()
  {
    $kelas = $this->input->post('kelas');
    if(!$kelas){
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "error","msg" => "Terjadi kesalahan ketika menambah data!"));
      redirect('users/list_kelas');
    } else {
      $this->db->insert('tbl_kelas', array('kelas_nama' => $kelas));
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "success","msg" => "Berhasil menambah user"));
      redirect('users/list_kelas');
    }
  }
  public function edit_kelas()
  {
    $id = $this->input->post('id');
    $kelas = $this->input->post('kelas');
    if(!$id){
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "error","msg" => "Terjadi kesalahan ketika merubah data!"));
      redirect('users/list_kelas');
    } else {
      $this->db->update('tbl_kelas', array('kelas_nama' => $kelas), 'id='.$id);
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "success","msg" => "Berhasil merubah kelas"));
      redirect('users/list_kelas');
    }
  }

  public function hapus_kelas()
  {
    $id = $this->input->post('id');
    $kelas = $this->input->post('kelas');
    if(!$id){
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "error","msg" => "Terjadi kesalahan ketika menghapus data!"));
      redirect('users/list_kelas');
    } else {
      $this->db->delete('tbl_kelas', 'id='.$id);
      $this->session->set_flashdata('msg_kelas', array("toast_type" => "success","msg" => "Berhasil menghapus kelas"));
      redirect('users/list_kelas');
    }
  }
}
