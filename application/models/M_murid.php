<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_murid extends CI_Model
{
  function getMurid($limit=0)
  {
    if($limit == 0){
      $murid = $this->db->query("SELECT s.* , k.kelas_nama FROM tbl_siswa AS s INNER JOIN tbl_kelas AS k ON(s.kelas_id=k.id)")->result_array();
    } else {
      $murid = $this->db->query("SELECT s.* , k.kelas_nama FROM tbl_siswa AS s INNER JOIN tbl_kelas AS k ON(s.kelas_id=k.id) ORDER BY id DESC LIMIT $limit")->result_array();
    }

    return $murid;
  }

  function add_murid($data)
  {
    return $this->db->insert('tbl_siswa', $data);
  }

  function edit_murid($data, $id)
  {
    return $this->db->update('tbl_siswa', $data,'id='.$id);
  }

  function get_all_kelas()
  {
    return $this->db->get('tbl_kelas')->result_array();
  }

  function murid(){
    $hsl=$this->db->get('tbl_siswa');
    return $hsl;
  }
  function murid_perpage($offset,$limit){
    $hsl=$this->db->query("SELECT * FROM tbl_siswa limit $offset,$limit");
    return $hsl;
  }
}
