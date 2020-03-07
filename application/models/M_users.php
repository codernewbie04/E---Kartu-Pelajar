<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model
{
  function validation($username, $password)
  {
    $query = $this->db->get_where('tbl_users', ['username' => $username]);
    if(!$username || !$password)
    {
      return false;
    } else if($query->num_rows() > 0){
      $pwd = $query->row_array()['password'];
      $check = password_verify($password , $pwd);
      if($check){
        $user = $this->db->get_where('tbl_users', ['username' => $username])->row_array();
        $uid=$user['id'];
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  function add_user($data)
  {
    $this->db->insert('tbl_users', $data);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < 40; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }
    $uid = $this->db->get_where('tbl_users',['username' => $data['username']])->row_array()['id'];
    $data_token = [
      'user_id' => $uid,
      'token' => $token,
      'level' => 1,
      'ignore_limits' => 0,
      'is_private_key' => 0,
      'date_created' => time()
    ];
    $insert_token = $this->db->insert('access_token', $data_token);
    return $insert_token;
  }
  function getData($username = null)
  {
    if($username == null){
      // menampilkan banyak user
      $users = $this->db->get('tbl_users')->result_array();
      foreach ($users as $value) {
        $data[] = array('id' => $value['id'], 'username' => $value['username'], 'nama' => $value['nama'], 'email' => $value['email'], 'level' => $value['level'], 'joindate' => $value['joindate'],
        'photo' =>$value['photo']);
      }
      return $data;
    } else {
      // menampilkan 1 user
      $user = $this->db->query("SELECT * FROM tbl_users WHERE username ='$username'")->row_array();
      $uid=$user['id'];
      $accesstoken =  $this->db->query("SELECT * FROM access_token WHERE user_id ='$uid'")->row_array()['token'];
      return array('user_id' => $user['id'], 'username' => $username, 'password' => "", 'level' => $user['level'],
    'email' => $user['email'], 'nama' => $user['nama'], 'photo' => base_url()."assets/images/fp/".$user['photo'],
    'joindate' => $user['joindate'], 'access_token' =>$accesstoken);
    }
  }

  function update_user($data, $id)
  {
    return $this->db->update('tbl_users', $data, 'id='.$id);
  }

  function hapus_user($id)
  {
    return $this->db->delete('tbl_users', 'id='.$id);
  }


  function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
      $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
      $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
  }

  public function CreateAccessToken($length = 40) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  function register($username, $email, $nama, $kelas, $password, $imageName)
  {
    $data = [
      'username' => $username,
      'email' => $email,
      'nama' => $nama,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'level'=>'murid',
      "kelas" => $kelas,
      'photo'=> $imageName,
      'joindate' => date("Y-m-d H:i:s")
    ];
    if($this->db->insert('tbl_users',$data)){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $token = '';
      for ($i = 0; $i < 40; $i++) {
          $token .= $characters[rand(0, $charactersLength - 1)];
      }
      $uid = $this->db->get_where('tbl_users',['username' => $username])->row_array()['id'];
      $data_token = [
        'user_id' => $uid,
        'token' => $token,
        'level' => 1,
        'ignore_limits' => 0,
        'is_private_key' => 0,
        'date_created' => time()
      ];
      $insert_token = $this->db->insert('access_token', $data_token);
      return $insert_token;
    }
  }

  function getPengajar($pengajar = null)
  {
    if($pengajar == null){
      $pengajar = $this->db->get('tbl_guru')->result_array();
      foreach ($pengajar as $value) {
        if($value['photo'] == null){
          $photo = '';
        } else {
          $photo = base_url('assets/images/guru/').$value['photo'];
        }
        $data[] = array('nama' => $value['nama'], 'bidang' => $value['mapel'], 'photo' => $photo);
      }
      return $data;
    } else {

    }
  }


  function validateEmail($email)
  {
    $get = $this->db->get_where("tbl_users", ['email' => $email]);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return array('status' => false, 'msg' => 'Format email tidak benar!');
      } else if($get->num_rows() > 0){
        return array('status' => false, 'msg' => 'Email sudah digunakan!');
      } else {
        return array('status' => true, 'msg' => 'Success Validasi Email!');
      }
  }


  function validateUsername($username)
  {
    $get = $this->db->get_where("tbl_users", ['username' => $username]);
      if(strlen($username) < 6){
        return array('status' => false, 'msg' => 'Data terlalu pendek!');
      } else if($get->num_rows() > 0){
        return array('status' => false, 'msg' => 'Username sudah digunakan!');
      } else {
        return array('status' => true, 'msg' => 'Success Validasi Email!');
      }
  }

  function getSiswa()
  {
    $siswa = $this->db->get('tbl_siswa')->result_array();
    foreach ($siswa as $value) {
      if($value['photo'] == null){
        $photo = '';
      } else {
        $photo = base_url('assets/images/siswa/').$value['photo'];
      }
      $data[] = array('nama' => $value['nama'], 'nis' => $value['nis'], 'jenkel' => "Laki-Laki", 'kelas' => 'XI - MIPA 3', 'photo' => $photo);
    }
    return $data;
  }

  function getPengumuman()
  {
    $pengumuman = $this->db->get('tbl_pengumuman')->result_array();
    foreach ($pengumuman as $value) {
      $data[] = array('id' => $value['id'], 'judul' => $value['judul'], 'isi_pengumuman' => $value['deskripsi'], 'tanggal' => $value['tanggal'], 'author' => $value['author']);
    }
    return $data;
  }

  function getKegiatan()
  {
    $pengumuman = $this->db->get('tbl_kegiatan')->result_array();
    foreach ($pengumuman as $value) {
      $data[] = array('id' => $value['id'], 'judul' => $value['judul'], 'deskripsi' => $value['deskripsi'], 'tanggal' => $value['tanggal'], 'mulai' =>$value['mulai'], 'selesai' =>$value['selesai'],
      'tempat' =>$value['tempat'], 'waktu' =>$value['waktu'], 'author' => $value['author']);
    }
    return $data;
  }

  function getBerita()
  {
    $berita = $this->db->get('tbl_berita')->result_array();
    foreach ($berita as $value) {
      $data[] = array('id' => $value['id'], 'judul' => $value['judul'], 'isi' => $value['isi'], 'joindate' => $value['joindate'], 'gambar' =>$value['gambar'], 'author' =>$value['author']);
    }
    return $data;
  }

  function detailKegiatan($id)
  {
    $get = $this->db->get_where('tbl_kegiatan', ['id' => $id])->row_array();

    $originalDate = $get['mulai'];
    $month = date("M Y", strtotime($originalDate));
    $day   = date("d", strtotime($originalDate));

    $originalDate2 = $get['tanggal'];
    $tanggal = date("Y-m-d", strtotime($originalDate));

    return array(
      'id' => $get['id'],
      'judul' => $get['judul'],
      'deskripsi' =>  $get['deskripsi'],
      'tempat' => $get['tempat'],
      'keterangan' => $get['keterangan'],
      'mulai' => $get['mulai'],
      'selesai' => $get['selesai'],
      'author' => $get['author'],
      'day' => $day,
      'waktu' =>$get['waktu'],
      'month' => $month,
      'tanggal' => $tanggal
    );
  }

  function getTugas()
  {
    $this->db->select('*');
    $this->db->from('tbl_tugas');
    $this->db->join('tbl_users', 'tbl_tugas.author_id = tbl_users.id');
    $tugas = $this->db->get()->result_array();
    foreach ($tugas as $value) {
      $data[] = array('id' => $value['id'], 'judul' => $value['judul'], 'deskripsi' => $value['deskripsi'], 'tanggal' => $value['tanggal'], 'author' => $value['nama'], 'target' => $value['target']);
    }
    return $data;
  }
}
