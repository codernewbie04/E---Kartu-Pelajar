<?php
class Setting extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			$url=base_url('login');
			redirect($url);
		};
		$this->load->model('m_setting', "setting");
		$this->load->library('upload');
	}

	function konfigurasi()
	{
		$x['setting'] = $this->setting->get_setting();
		$this->load->view('templates/header',$x);
		$this->load->view('v_setting');
		$this->load->view('templates/footer');
	}
	function update_konfigurasi()
	{
		$nama_web 	= $this->input->post('nama_web');
		$alamat			=	$this->input->post('alamat');
		$email			= $this->input->post('email');
		$author			= $this->input->post('author');

		if(!$nama_web || !$alamat || !$email || !$author){
			$this->session->set_flashdata('msg_setting', array("toast_type" => "error","msg" => "Data tidak boleh kosong!"));
			redirect('setting/konfigurasi');
		} else {
			$data = array(
				'nama_web' => $nama_web,
				'alamat' => $alamat,
				'email' => $email,
				'author' => $author
			);
			$this->setting->update_setting($data);
			$this->session->set_flashdata('msg_setting', array("toast_type" => "success","msg" => "Berhasil merubah konfigurasi"));
			redirect('setting/konfigurasi');
		}
	}

}
