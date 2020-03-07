<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Setting
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Pengaturan Web</li>
      <li class="active">Konfigurasi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <!-- MAP & BOX PANE -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Konfigurasi Website</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            <form role="form" method="post" action="<?=base_url('setting/update_konfigurasi');?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_web"><span style="color:#FF4A23;">*)</span> Nama Website </label>
                  <input type="text" class="form-control" id="nama_web" name="nama_web" placeholder="Ex: S - PNF" value="<?=$setting["nama_web"];?>" required>
                </div>
                <div class="form-group">
                  <label for="alamat"><span style="color:#FF4A23;">*)</span> Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Jl. Example Street 15" value="<?=$setting["alamat"];?>" required>
                </div>
                <div class="form-group">
                  <label for="email"><span style="color:#FF4A23;">*)</span> Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.ex" value="<?=$setting["email"];?>" required>
                </div>
                <div class="form-group">
                  <label for="author"><span style="color:#FF4A23;">*)</span> Author</label>
                  <input type="text" class="form-control" id="author" name="author" placeholder="0262 XXXXXX" value="<?=$setting["author"];?>" required>
                </div>

                <p><span style="color:#FF4A23;">*)</span> Wajib diisi</p>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
  <?php
  if($this->session->flashdata('msg_setting')['toast_type'] == 'success'){
    ?>
    $.toast({
      heading: 'Success',
      text: "<?=$this->session->flashdata('msg_setting')['msg'];?>",
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: 4000,
      position: 'bottom-right',
      bgColor: '#7EC857'
    });
    <?php
  } else if($this->session->flashdata('msg_setting')['toast_type'] == 'error'){
    ?>
    $.toast({
      heading: 'Error',
      text: "<?=$this->session->flashdata('msg_setting')['msg'];?>",
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
