<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Rfid extends REST_Controller{
	function __construct($config = 'rest'){
		parent::__construct($config);
    $this->load->model('m_users', 'users');
    $this->load->model('m_murid', 'murid');
    $this->config->load('rest');
		if($this->uri->segment(2) == "getRfid"){
    	$this->config->set_item('rest_enable_keys', TRUE);
		} else {
			$this->config->set_item('rest_enable_keys', FALSE);
		}
	}

	function getRfid_GET(){
    $UIDresult=$_GET["rfid_key"];
    $Write="<?php
    $"."expired='".strtotime('+1 second', strtotime(date("Y-m-d H:i:s")))."';
    $"."now= strtotime(date('Y-m-d H:i:s'));
    if($"."now <= $"."expired ){
    $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . "}?>";
    file_put_contents('UIDContainer.php',$Write);
		}

		function getdata_POST()
		{
			$rfidkey = $this->input->post('rfid_key');
			$get = $this->db->query("SELECT * FROM tbl_siswa AS s INNER JOIN tbl_kelas as k ON(s.kelas_id = k.id) WHERE rfid_key='$rfidkey'");
			if($get->num_rows() < 1){
				$result = array('status' => false,
				'msg' => 'RFID tidak terdaftar',
				'data' => null
			);
			return $this->response($result, REST_Controller::HTTP_OK);
			} else {
				$data = $get->last_row("array");
				$result = array('status' => true,
				'msg' => 'Data ditemukan!',
				'data' => $data
			);
			return $this->response($result, REST_Controller::HTTP_OK);
			}
		}
}
