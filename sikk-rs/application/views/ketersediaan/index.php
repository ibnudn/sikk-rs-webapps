<div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1 class="text-center display-6">Informasi Ketersediaan Kamar Rumah Sakit Kota Surakarta</h1>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">
            <nav role="navigation">
                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="faskes-tab" data-bs-toggle="pill" href="#isi-faskes-tab" role="tab"aria-selected="true">Ketersediaan Kamar berdasarkan Faskes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="kelas-tab" data-bs-toggle="pill" href="#isi-kelas-tab" role="tab" aria-controls="pills-profile" aria-selected="false">Ketersediaan Kamar berdasarkan Kelas</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="row" id="isi-faskes-tab">
                        </div>
                    </div>
                    <div class="tab-pane fade show active" role="tabpanel" >
                        <div class="row" id="isi-kelas-tab">
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Modal Faskes -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-head">Nama Faskes</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col">
							<div id="map"></div>   
						</div>
						<div class="col">
							<div id="alamat-faskes"></div>
							<div id="website-faskes"></div>
							<div id="card-detail"></div>
						</div>
					</div>
                    <!-- <div class="card bg-teal-200 mb-3">
                        <div class="card-body">
                            <h1 class="card-title">Kelas</h1>
                            <p class="card-text">Kamar Tersedia</p>
                            <h2 class="card-text fw-lighter" id="ketersediaan">angka</h2>
                        </div>
                        <div class="card-footer">
                        </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kelas -->
    <div class="modal fade" id="modal_K">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-head-K">Nama Kelas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col">
							<div id="card-detail-K"></div>
						</div>
					</div>
                    <!-- <div class="card bg-teal-200 mb-3">
                        <div class="card-body">
                            <h1 class="card-title">Kelas</h1>
                            <p class="card-text">Kamar Tersedia</p>
                            <h2 class="card-text fw-lighter" id="ketersediaan">angka</h2>
                        </div>
                        <div class="card-footer">
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

