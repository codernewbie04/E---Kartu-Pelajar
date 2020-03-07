<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Users
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Users</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addUserModal"><span class="fa fa-user-plus"></span> Add User</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th style="text-align:center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $i) {
                    $id=$i['id'];
                    $nama=$i['nama'];
                    $email=$i['email'];
                    $username=$i['username'];
                    $level=$i['level'];
                    $photo=$i['photo'];
                    ?>
                    <tr>
                      <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/fp/'.$photo;?>"></td>
                      <td><?php echo $nama;?></td>
                      <td><?php echo $email;?></td>
                      <?php
                      if($level == 'admin'){
                        echo '<td>Admin</td>';
                      } else if($level == 'guru'){
                        echo '<td>Guru</td>';
                      } else {
                        echo '<td>Seller</td>';
                      }
                      ?>
                      <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span></a>
                        <?php if($username !== $my_data['username']){ ?>
                          <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id;?>"><span class="fa fa-trash"></span></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="addUserModalLabel">Add Users</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'users/add_user'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputUserName">Nama</label>
                <input type="text" name="nama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" value="<?=$this->session->flashdata('value_users')['nama'];?>" required>
                <div class="invalid-feedback">
                  <?=form_error('username');?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?=$this->session->flashdata('value_users')['email'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?=$this->session->flashdata('value_users')['username'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputPassword3">Password</label>
                <input type="text" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="level">Level</label>
                <select class="form-control" name="level" id ="level" required>
                  <option <?php echo ($this->session->flashdata('value_users')['level'] =='seller')?"selected":'';?> value="seller">Seller</option>
                  <option <?php echo ($this->session->flashdata('value_users')['level'] =='guru')?"selected":'';?> value="guru">Guru</option>
                  <option <?php echo ($this->session->flashdata('value_users')['level'] =='admin')?"selected":'';?> value="admin">Administrator</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="photo">Photo <span style="color:#CACACA;">(Opsional)</span></label>
                <input type="file" name="filefoto" id="photo" accept=".jpg,.png"/>
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  foreach ($users as $val) {
    ?>
    <div class="modal fade" id="ModalEdit<?=$val['id'];?>"  role="dialog" aria-labelledby="ModalEdit<?=$val['id'];?>Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ModalEdit<?=$val['id'];?>Label">Edit User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?=base_url('users/edit_user');?>">
              <div class="box-body">
                <input type="text" name="id" placeholder="Don't Touch" value="<?=$val["id"];?>" required hidden>
                <div class="col-md-12 p-3">
                  <div class="text-center">
                    <img src="<?php echo base_url().'assets/images/fp/'.$val['photo'];?>" class="rounded float-center" style="width: 150px; height: 164px;">
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" value="<?=$val["username"];?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="password">Password Baru <span style="color:#CACACA;">(Opsional)</span></label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Ex: Andi" value="<?=$val['nama'];?>" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Ex: example@domain.ex" value="<?=$val['email'];?>" required>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select class="form-control" name="level" id ="level" required>
                    <option <?php echo ($val['level'] =='seller')?"selected":'';?> value="seller">Seller</option>
                    <option <?php echo ($val['level'] =='guru')?"selected":'';?> value="guru">Guru</option>
                    <option <?php echo ($val['level'] =='admin')?"selected":'';?> value="admin">Administrator</option>
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="ModalHapus<?=$val['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Hapus Slider</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url('users/hapus_users')?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
              <p>Apakah Anda yakin mau menghapus akun <b><?php echo $val['username'];?></b> ?</p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
  }
  ?>

  <script type="text/javascript">
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  <?php
  if($this->session->flashdata('msg_users')['toast_type'] == 'success'){
    ?>
    $.toast({
      heading: 'Success',
      text: '<?=$this->session->flashdata("msg_users")["msg"];?>',
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: 4000,
      position: 'bottom-right',
      bgColor: '#7EC857'
    });
    <?php
  } else if($this->session->flashdata('msg_users')['toast_type'] == 'error'){
    ?>
    $.toast({
      heading: 'Error',
      text: '<?=trim($this->session->flashdata("msg_users")["msg"]);?>',
      showHideTransition: 'slide',
      icon: 'error',
      hideAfter: 4000,
      position: 'bottom-right',
      bgColor: '#FF4859'
    });
    <?php
  }
  ?>
</script>
