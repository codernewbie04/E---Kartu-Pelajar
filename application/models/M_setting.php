<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setting extends CI_Model
{
  function get_setting()
  {
    return $this->db->get("tbl_setting")->last_row("array");
  }

  function update_setting($data)
  {
    $this->db->update('tbl_setting', $data);
  }
}
