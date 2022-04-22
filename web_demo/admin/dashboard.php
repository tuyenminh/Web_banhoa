<?php
if (!defined('hang')) {
	die('ban truy cap sai cach');
}
// $sql="SELECT * FROM sanphams";
$query = "SELECT `DANHMUCS`.*, COUNT(SANPHAMS.DM_ID) AS NUMBER_DANHMUCS FROM sanphams
INNER JOIN DANHMUCS ON SANPHAMS.DM_ID = DANHMUCS.DM_ID GROUP BY SANPHAMS.DM_ID";
$result = mysqli_query($connect, $query);
$data = [];
while ($row = mysqli_fetch_array($result)){
	$data[]= row;
} 
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Trang chủ quản trị</li>
		</ol>
	</div>
	<!--/.row-->
<!DOCTYPE html>
		<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['dm_ten', 'dm_id'],
          <?php
		  foreach ($data as $key) {
			echo "['".$key['dm_ten']."' . " .$key['dm_id']. "]. ";
		  }
		  ?>
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>

	</div>
	<!--/.row-->
</div>
<!--/.main-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>