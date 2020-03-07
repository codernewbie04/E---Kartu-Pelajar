<?php
class Murid extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
        };
		$this->load->model('m_setting', "setting");
    $this->load->model('m_users', 'users');
    $this->load->model('m_murid', 'murid');
	}

	function index(){
			$x['setting'] = $this->setting->get_setting();
			$x['murid'] = $this->murid->getMurid();
      $username     = $this->session->userdata('username');
      $x['my_data']   = $this->users->getData($username);
      $x['kelas_list'] = $this->murid->get_all_kelas();
			$this->load->view('templates/header',$x);
			$this->load->view('v_murid');
			$this->load->view('templates/footer');
		}
}
