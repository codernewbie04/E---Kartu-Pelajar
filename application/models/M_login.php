<?php
class M_login extends CI_Model{
  function cekadmin($username, $password)
  {
    $query = $this->db->get_where('tbl_users', ['username' => $username]);
    if(!$username || !$password)
    {
      return false;
    } else if($query->num_rows() > 0){
      $pwd = $query->row_array()['password'];
      $check = password_verify($password , $pwd);
      if($check){
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  function getData($username = null)
  {
      // menampilkan 1 user
      $user = $this->db->query("SELECT * FROM tbl_users WHERE username ='$username'")->row_array();
      $uid=$user['id'];
      $accesstoken =  $this->db->query("SELECT * FROM access_token WHERE user_id ='$uid'")->row_array()['token'];
      return $user;
  }

}
