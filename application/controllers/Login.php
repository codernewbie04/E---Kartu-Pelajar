<?php
class Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_setting', 'setting');
        $this->load->model('m_login', 'login');
    }
    function index()
    {
      if($this->session->userdata('masuk')==TRUE){
              $url=base_url('dashboard');
              redirect($url);
          };
      $x['setting'] = $this->setting->get_setting();
      $this->form_validation->set_rules('username', 'Username', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_login_check');
      if($this->form_validation->run() == false){
        $this->form_validation->set_message('username','required', 'Username tidak kosong');
        $this->load->view('v_login',$x);
      } else {
        $user = $this->login->getData($this->input->post('username'));
        $idadmin=$user['id'];
        $user_nama=$user['nama'];
        $username = $user['username'];;
        if($user['level']=='admin'){
            $this->session->set_userdata('masuk',true);
            $this->session->set_userdata('akses','1');
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('username',$username);
            $this->session->set_userdata('nama',$user_nama);
            redirect('dashboard');
         } else if($user['level']=='guru'){
             $this->session->set_userdata('masuk',true);
             $this->session->set_userdata('akses','2');
             $this->session->set_userdata('idadmin',$idadmin);
             $this->session->set_userdata('username',$username);
             $this->session->set_userdata('nama',$user_nama);
             redirect('dashboard');
         } else {
           $this->load->view('v_login',$x);
         }
      }
    }
    public function login_check()
    {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      if($this->db->get_where('tbl_users',['username' => $username])->num_rows() < 1){
        $this->form_validation->set_message('login_check', 'Username tidak ditemukan!');
        return FALSE;
      } else if(!$this->login->cekadmin($username, $password)){
        $this->form_validation->set_message('login_check', 'Password Salah!');
        return FALSE;
      } else {
        return TRUE;
      }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
