<div class="content-wrapper">
  <section class="content-header">
    <h1>
      List Kelas
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Users</li>
      <li class="active">List Kelas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addKelas"><span class="fa fa-plus"></span> Add Kelas</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                  <tr>
                    <th>ID Kelas</th>
                    <th>Kelas</th>
                    <th style="text-align:center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($kelas_list as $val) {
                    ?>
                    <tr>
                      <td><?=$val['id'];?></td>
                      <td><?=$val['kelas_nama'];?></td>
                      <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?=$val['id'];?>"><span class="fa fa-pencil"></span></a>
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?=$val['id'];?>"><span class="fa fa-trash"></span></a>
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




  <div class="modal fade" id="addKelas" tabindex="-1" role="dialog" aria-labelledby="addKelasLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="addKelasLabel">Add Kelas</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'users/add_kelas'?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <div class="col-sm-12">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Ex: XII - MIPA 3" required>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat" id="simpan">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <?php
  foreach ($kelas_list as $val) {
    ?>
    <div class="modal fade" id="ModalEdit<?=$val['id'];?>"  role="dialog" aria-labelledby="ModalEdit<?=$val['id'];?>Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ModalEdit<?=$val['id'];?>Label">Edit Kelas</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?=base_url('users/edit_kelas');?>">
              <div class="box-body">
                <input type="text" name="id" placeholder="Don't Touch" value="<?=$val["id"];?>" required hidden>
                <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <input type="text" class="form-control" id="kelas" name="kelas" value="<?=$val["kelas_nama"];?>" required>
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
            <h4 class="modal-title" id="myModalLabel">Hapus Kelas</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url('users/hapus_kelas')?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
              <p>Apakah Anda yakin mau menghapus kelas <b><?php echo $val['kelas_nama'];?></b> ?</p>

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
if($this->session->flashdata('msg_kelas')['toast_type'] == 'success'){
  ?>
  $.toast({
    heading: 'Success',
    text: '<?=$this->session->flashdata("msg_kelas")["msg"];?>',
    showHideTransition: 'slide',
    icon: 'success',
    hideAfter: 4000,
    position: 'bottom-right',
    bgColor: '#7EC857'
  });
  <?php
} else if($this->session->flashdata('msg_kelas')['toast_type'] == 'error'){
  ?>
  $.toast({
    heading: 'Error',
    text: '<?=trim($this->session->flashdata("msg_kelas")["msg"]);?>',
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
