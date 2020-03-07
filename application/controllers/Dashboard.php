<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
        };
		$this->load->model('m_setting', "setting");
		$this->load->model('m_pengunjung');
	}

		public function index(){
			$x['setting'] = $this->setting->get_setting();
			$x['visitor'] = $this->m_pengunjung->statistik_pengujung();
			$this->load->view('templates/header',$x);
			$this->load->view('v_dashboard',$x);
			$this->load->view('templates/footer');
		}
}
