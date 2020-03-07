<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Murid
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Murid</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addmuridModal"><span class="fa fa-user-plus"></span> Add Murid</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>RFID Key</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Saldo</th>
                    <th>Alamat</th>
                    <th style="text-align:center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($murid as $i) {
                    $id=$i['id'];
                    $key=$i['rfid_key'];
                    $nama=$i['nama'];
                    $nis=$i['nis'];
                    $alamat=$i['alamat'];
                    $kelas=$i['kelas_nama'];
                    $jenkel=($i['jenkel']=="L"?"Laki - Laki":"Perempuan");
                    $photo=$i['photo'];
                    $saldo="Rp " . number_format($i['saldo'],0,',','.');
                    ?>
                    <tr>
                      <td><img width="40" height="40" class="img-circle" src="<?php echo base_url("assets/images/murid/").$photo;?>"></td>
                      <td><?=$key;?></td>
                      <td><?=$nis;?></td>
                      <td><?=$nama;?></td>
                      <td><?=$jenkel;?></td>
                      <td><?=$kelas;?></td>
                      <td><?=$saldo;?></td>
                      <td><?=$alamat;?></td>
                      <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span></a>
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id;?>"><span class="fa fa-trash"></span></a>
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


  <div class="modal fade" id="addmuridModal" tabindex="-1" role="dialog" aria-labelledby="addmuridModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="addmuridModalLabel">Add murid</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'users/add_murid'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputUserName">RFID Key</label>
                <input type="text" name="rfid_key" class="form-control" id="rfid_key2" placeholder="12345xxxx" value="<?=$this->session->flashdata('value_murid')['rfid_key'];?>" required>
                <p id="note_rfid">*) Silakan tempelkan kartu pada sensor</p>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputUserName">NIS</label>
                <input type="text" name="nis" class="form-control" id="nis" placeholder="12345678xxxx" value="<?=$this->session->flashdata('value_murid')['nis'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputUserName">Nama</label>
                <input type="text" name="nama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" value="<?=$this->session->flashdata('value_murid')['nama'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4">Jenis Kelamin</label>
              <div class="col-sm-12">
                <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="L" name="jenkel" checked>
                  <label for="inlineRadio1"> Laki-Laki </label>
                </div>
                <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="P" name="jenkel">
                  <label for="inlineRadio2"> Perempuan </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
              <label>Kelas</label>
              <select class="form-control select2" name="kelas" id="kelas" required>
                <?php
                foreach ($kelas_list as $row) {
                  ?>
                  <option value="<?=$row['id'];?>"><?=$row['kelas_nama'];?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="photo">Photo</label>
                <input type="file" name="filefoto" id="photo" accept=".jpg,.png" required/>
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
  foreach ($murid as $val) {
    ?>
    <div class="modal fade" id="ModalEdit<?=$val['id'];?>"  role="dialog" aria-labelledby="ModalEdit<?=$val['id'];?>Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ModalEdit<?=$val['id'];?>Label">Edit murid</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?=base_url('users/edit_murid');?>">
              <div class="box-body">
                <input type="text" name="id" placeholder="Don't Touch" value="<?=$val["id"];?>" required hidden>
                <div class="col-md-12 p-3">
                  <div class="text-center">
                    <img src="<?php echo base_url("assets/images/murid/").$val['photo'];?>" class="rounded float-center" style="width: 150px; height: 164px;">
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <label for="edit_nis<?=$val["id"];?>">NIS</label>
                    <input type="text" class="form-control" placeholder="NIS" name="nis" id="edit_nis<?=$val["id"];?>" value="<?=$val["nis"];?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <label for="edit_nama<?=$val["id"];?>">Nama</label>
                    <input type="text" class="form-control" id="edit_nama<?=$val["id"];?>" name="nama" placeholder="Ex: Andi" value="<?=$val['nama'];?>" value="value="<?=$val["nama"];?>"" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4">Jenis Kelamin</label>
                  <div class="col-sm-12">
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="edit_jenkel<?=$val["id"];?>" value="L" name="jenkel" <?=($val['jenkel'] =='L')?"checked":'';?>>
                      <label for="edit_jenkel<?=$val["id"];?>"> Laki-Laki </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="edit_jenkel<?=$val["id"];?>" value="P" name="jenkel" <?=($val['jenkel'] =='P')?"checked":'';?>>
                      <label for="edit_jenkel<?=$val["id"];?>"> Perempuan </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                  <label>Kelas</label>
                  <select class="form-control select2" name="kelas" required>
                    <?php
                    foreach ($kelas_list as $row) {
                      ?>
                      <option <?php echo ($val['kelas_id'] == $row['id'])?"selected":'';?> value="<?=$row['id'];?>"><?=$row['kelas_nama'];?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
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
            <h4 class="modal-title" id="myModalLabel">Hapus murid</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url('users/hapus_murid')?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
              <p>Apakah Anda yakin mau menghapus akun <b><?php echo $val['nama'];?></b> ?</p>

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
    $('.select2').select2()
    setInterval(function() {
      $.ajax({url: "/share/UIDContainer.php", success: function(result){
        if(result){
          $("#note_rfid").fadeOut();
          $("#rfid_key2").val(result);
        }
      }});
      var val_rfid = $("#rfid_key2").val();
      if(!val_rfid){
        $("#note_rfid").fadeIn();
      }
    }, 500);
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
  if($this->session->flashdata('msg_murid')['toast_type'] == 'success'){
    ?>
    $.toast({
      heading: 'Success',
      text: '<?=$this->session->flashdata("msg_murid")["msg"];?>',
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: 4000,
      position: 'bottom-right',
      bgColor: '#7EC857'
    });
    <?php
  } else if($this->session->flashdata('msg_murid')['toast_type'] == 'error'){
    ?>
    $.toast({
      heading: 'Error',
      text: '<?=trim($this->session->flashdata("msg_murid")["msg"]);?>',
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
