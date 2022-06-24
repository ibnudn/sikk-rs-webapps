<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

		<?= $this->session->flashdata('mssg'); ?>

        <!-- Page Heading -->
        <h1 class="display-4 mb-4 text-gray-800">Welcome</h1>
        <h5>Dashboard <strong><?= ($faskes) ? $faskes['nama_faskes'] : $this->session->username;?></strong></h5>

		<!-- Content Row -->
		<div class="row mt-4">

			<!-- Jumlah Kapasitas -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Jumlah Kapasitas</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_kapasitas[0]->kapasitas?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-hospital-user fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Jumlah Ketersediaan-->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Jumlah Ketersediaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_ketersediaan[0]->ketersediaan?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-hospital-user fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /.row -->

		<!-- Content Row -->
		<div class="row">
			<!-- Pie Chart Kapasitas -->
			<div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Kapasitas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="pie-kap"></canvas>
                        </div>
                        <div class="mt-4 text-center small" id="pie-label-kap">
                            <!-- <span class="mr-2">
                                <i class="fas fa-circle"></i> <?= $row['nama_kelas']?>
                            </span> -->
                        </div>
                    </div>
                </div>
            </div>

			<!-- Pie Chart Ketersediaan-->
			<div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Ketersediaan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="pie-ket"></canvas>
                        </div>
                        <div class="mt-4 text-center small" id="pie-label-ket">
                            <!-- <span class="mr-2">
                                <i class="fas fa-circle"></i> <?= $row['nama_kelas']?>
                            </span> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
		<!-- /.row -->

	</div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
<script type="text/javascript">
var kapasitas = <?= json_encode($kapasitas); ?>;
var nama_kap = new Array();
var jum_kap = new Array();
var warna_kap = new Array();
// console.log(kapasitas);

$.each(kapasitas, function(index, value) {
	// console.log(value.nama_kelas);
	nama_kap.push(value.nama_kelas);
	jum_kap.push(value.kapasitas);
	warna_kap.push(getRandomColor());
});
var i = 0;
$.each(nama_kap, function(index, value) {
	$('#pie-label-kap').append(`
		<span class="mr-2">
			<i class="fas fa-circle" style="color:`+warna_kap[i]+`;"></i>`+value+`
		</span>`);
	i++;
}); 
// console.log(nama_kap);
// Pie Chart Example
var pie_kap = document.getElementById("pie-kap");
var piechart_kap = new Chart(pie_kap, {
	type: 'doughnut',
	data: {
		labels: nama_kap,
		datasets: [{
			data: jum_kap,
			backgroundColor: warna_kap,
		}],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
		},
		legend: {
			display: false
		},
		cutoutPercentage: 80,
	},
});

var ketersediaan = <?= json_encode($ketersediaan); ?>;
var nama_ket = new Array();
var jum_ket = new Array();
var warna_ket = new Array();
console.log(ketersediaan);

$.each(ketersediaan, function(index, value) {
	// console.log(value.nama_kelas);
	nama_ket.push(value.nama_kelas);
	jum_ket.push(value.ketersediaan);
	// console.log(value.ketersediaan);
	warna_ket.push(getRandomColor());
});
var i = 0;
$.each(nama_ket, function(index, value) {
	$('#pie-label-ket').append(`
		<span class="mr-2">
			<i class="fas fa-circle" style="color:`+warna_ket[i]+`;"></i>`+value+`
		</span>`);
	i++;
}); 
console.log(nama_ket);
// Pie Chart Example
var pie_ket = document.getElementById("pie-ket");
var piechart_ket = new Chart(pie_ket, {
	type: 'doughnut',
	data: {
		labels: nama_ket,
		datasets: [{
			data: jum_ket,
			backgroundColor: warna_ket,
		}],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
		},
		legend: {
			display: false
		},
		cutoutPercentage: 80,
	},
});

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
	color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
</script>
