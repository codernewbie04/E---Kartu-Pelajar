

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2017 <a href=""><?=$setting['nama_web'];?></a>.</strong> All rights reserved.
</footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- ChartJS 1.0.1 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>

<script>
$( document ).ready(function() {
  var url = window.location;
  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
  	 return this.href == url;
  }).parents("li").addClass('active');

  // for treeview

   $('ul.treeview a').filter(function() {
   	 return this.href == url;
    }).addClass('active');
    $('ul.treeview-menu a').filter(function() {
    	 return this.href == url;
     }).parent().addClass('active');
});
<?php
/* Mengambil query report*/
foreach($visitor as $result){
  $bulan[] = $result->tgl. date(" M"); //ambil bulan
  $value[] = (float) $result->jumlah; //ambil nilai
}
/* end mengambil query*/
if($this->uri->segment(2) == "dashboard"){
  ?>
  var lineChartData = {
    labels : <?php echo json_encode($bulan);?>,
    datasets : [
      {
        label: 'Jumlah kunjungan website',
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(152,235,239,1)",
        data : <?php echo json_encode($value);?>
      }

    ]

  }
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          userCallback: function(label, index, labels) {
            // when the floored value is the same as the value we have a whole number
            if (Math.floor(label) === label) {
              return label;
            }

          },
        }
      }],
    },
  }
  var ctx = document.getElementById("canvas");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: lineChartData,
    options: options
  });
  <?php
}

?>
</script>

</body>
</html>
