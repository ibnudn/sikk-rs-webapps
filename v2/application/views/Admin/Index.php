<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="display-4 mb-4 text-gray-800">Welcome</h1>
        <h5>Dashboard <?= $this->session->role; ?></h5>

		<!-- Content Row -->
		<div class="row mt-4">

			<!-- Jumlah User -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Jumlah Data User</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_user?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Jumlah Faskes -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									Jumlah Data Faskes</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_faskes?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-hospital-alt fa-2x text-gray-300"></i>
							</div>
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
