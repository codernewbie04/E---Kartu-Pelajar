<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-chrome"></i></span>
          <?php
          $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Chrome'");
          $jml=$query->num_rows();
          ?>
          <div class="info-box-content">
            <span class="info-box-text">Chrome</span>
            <span class="info-box-number"><?php echo $jml;?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-firefox"></i></span>
          <?php
          $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Firefox' OR pengunjung_perangkat='Mozilla'");
          $jml=$query->num_rows();
          ?>
          <div class="info-box-content">
            <span class="info-box-text">Mozilla Firefox</span>
            <span class="info-box-number"><?php echo $jml;?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-bug"></i></span>
          <?php
          $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Googlebot'");
          $jml=$query->num_rows();
          ?>
          <div class="info-box-content">
            <span class="info-box-text">Googlebot</span>
            <span class="info-box-number"><?php echo $jml;?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-opera"></i></span>
          <?php
          $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Opera'");
          $jml=$query->num_rows();
          ?>
          <div class="info-box-content">
            <span class="info-box-text">Opera</span>
            <span class="info-box-number"><?php echo $jml;?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="callout callout-info" id="tip">
      <h4>Tempelkan Kartu!</h4>
      Silakan tempelkan kartu pelajar pada sensor RFID untuk melihat detail user
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Detail User</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="col-md-12 p-3" hidden id="pict">
            <div class="text-center">
              <img id="photo_user" src="<?=base_url();?>assets/images/nopic.png" class="rounded float-center" style="width: 150px; height: 164px;">
            </div>
            <br>
          </div>
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="rfid_key">RFID Key</label>
                <input type="text" class="form-control" id="rfid_key" placeholder="RFID Key" readonly>
              </div>
              <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" id="nis" placeholder="NIS Siswa" readonly>
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama" readonly>
              </div>
              <div class="form-group">
                <label for="jenkel">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jenkel" placeholder="Jenis Kelamin" readonly>
              </div>
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" id="kelas" placeholder="Kelas" readonly>
              </div>
              <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="text" class="form-control" id="saldo" placeholder="Saldo" readonly>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" rows="3" class="form-control" readonly></textarea>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<script type="text/javascript">
var interval = null;
$(function () {
  playinterval();
});

function getRfid() {
  $.ajax({url: "<?=base_url();?>UIDContainer.php", success: function(result){
    if(result){
      $.ajax({
        type:"POST",
        url: "<?=base_url();?>rfid/getdata",
        data:"rfid_key="+result,
        success: function(result2){
          if(result2.status == true){
            if(result2.data.jenkel == "L"){
              var jenkel = "Laki - Laki";
            } else {
              var jenkel = "Perempuan";
            }
            $("#nis").val(result2.data.nis);
            $("#nama").val(result2.data.nama);
            $("#jenkel").val(jenkel);
            $("#kelas").val(result2.data.kelas_nama);
            $("#saldo").val(result2.data.saldo);
            $("#alamat").html(result2.data.alamat);
            $("#photo_user").attr("src", "<?=base_url();?>assets/images/murid/"+result2.data.photo);
            $("#pict").fadeIn();
          } else {
            $("#nis").val(null);
            $("#nama").val(null);
            $("#jenkel").val(null);
            $("#kelas").val(null);
            $("#saldo").val(null);
            $("#alamat").html(null);
            $("#pict").fadeOut();
            stopinterval();
            Swal.fire({
              title: 'Gagal!',
              text: "Data tidak terdaftar pada databse!",
              icon: 'error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((result) => {
                playinterval();
            })
            $("#tip").fadeIn();
          }
        }});
        $("#tip").fadeOut();
        $("#rfid_key").val(result);
      }
    }});
  }

  function playinterval(){
  interval = setInterval(function(){getRfid();},1000);
  return false;
}

function stopinterval(){
  clearInterval(interval);
  return false;
}

</script>
