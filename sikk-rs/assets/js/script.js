var base_url = $('#base').val();
console.log(base_url);

const showElapsedTime = (timestamp) => {
	if (typeof timestamp !== 'number') return 'NaN'   ;     
	
    const SECOND = 1000;
    const MINUTE = 1000 * 60;
    const HOUR = 1000 * 60 * 60;
    const DAY = 1000 * 60 * 60 * 24;
    const MONTH = 1000 * 60 * 60 * 24 * 30;
    const YEAR = 1000 * 60 * 60 * 24 * 30 * 12;
    
    // const elapsed = ((new Date()).valueOf() - timestamp)
    const elapsed = Date.now() - timestamp;
    
    if (elapsed <= MINUTE) return `${Math.round(elapsed / SECOND)} detik`
    if (elapsed <= HOUR) return `${Math.round(elapsed / MINUTE)} menit`
    if (elapsed <= DAY) return `${Math.round(elapsed / HOUR)} jam`
    if (elapsed <= MONTH) return `${Math.round(elapsed / DAY)} hari`
    if (elapsed <= YEAR) return `${Math.round(elapsed / MONTH)} bulan`
    return `${Math.round(elapsed / YEAR)} tahun`;
}

faskes();

$('#faskes-tab').on('click', function() {
	faskes();
});

$('#kelas-tab').on('click', function() {
	kelas();
});

function faskes() {
	let faskes = dataFaskes;
    console.log(faskes);
	
    $('#isi-kelas-tab').html('');
	
    faskes.forEach(data => {
		// console.log(data);
        let persen = data.tersedia / data.kapasitas * 100;
        let bulat = Math.round(persen);
		
        $('#isi-faskes-tab').append(`
		<div class="col-md-4">
		    <div class="card pointer mb-3" onclick="modalFaskes('` + data.nama + `', '` + data.alamat + `', '` + data.website + `', '` + data.koordinat + `')">
		        <div class="card-body">
		            <h1 class="card-title">` + data.tersedia + `</h1>
		            <p class="card-text">Kamar Tersedia</p>
		            <h2 class="card-text fw-lighter">` + data.nama + `</h2>
		        </div>
		        <div class="card-footer">
		            <h6 class="card-subtitle mb-2 text-muted text-center">` + bulat + `% kamar tersedia dari ` + data.kapasitas + ` kamar</h6>
		            <div class="progress">
		                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: ` + persen + `%"></div>
		                </div>` 
		                + ((data.updated_at != null) ? 
		                `<p class="card-subtitle mt-2 fs-7 fw-light text-muted text-center">Update terakhir ` +  showElapsedTime(Date.parse(data.updated_at)) + ` yang lalu</p>
		            </div>
		        </div>
		    </div>` 
		: `<p class="card-subtitle mt-2 fs-7 fw-light text-muted text-center">Update terakhir ` +  showElapsedTime(Date.parse(data.created_at)) + ` yang lalu</p>
		</div>
		</div>
		</div>`)
        );
    });
}

function kelas() {
	$('#isi-faskes-tab').html('');
    $('#isi-kelas-tab').html('');
    
    let kelas = dataKelas;
    console.log(kelas);
    
    kelas.forEach(data => {
		let persen = data.tersedia/data.kapasitas*100;
        let bulat = Math.round(persen);
        
        $('#isi-kelas-tab').append(`
		<div class="col-md-4">
			<div class="card pointer mb-3" onclick="modalKelas('`+data.kelas+`')">
				<div class="card-body">
					<h1 class="card-title">`+data.tersedia+`</h1>
					<p class="card-text">Kamar Tersedia</p>
					<h1 class="card-text display-6">`+data.kelas+`</h1>
				</div>
				<div class="card-footer">
					<h6 class="card-subtitle mb-2 text-muted text-center">`+bulat+`% kamar tersedia dari `+data.kapasitas+` kamar</h6>
					<div class="progress">
						<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: `+persen+`%"></div>
					</div>`+ ((data.updated_at != null) ? 
						`<p class="card-subtitle mt-2 fs-7 fw-light text-muted text-center">Update terakhir ` +  showElapsedTime(Date.parse(data.updated_at)) + ` yang lalu</p>
					</div>
				</div>
			</div>` 
		: `<p class="card-subtitle mt-2 fs-7 fw-light text-muted text-center">Update terakhir ` +  showElapsedTime(Date.parse(data.created_at)) + ` yang lalu</p>
		</div>
		</div>
		</div>`)
        );
    });
}

var map = L.map('map');
var marker;

function modalFaskes(_nama, _alamat, _website, _koordinat) {
	// map.invalidateSize();
	$('#card-detail').html('');
    $('#modal-head').html(_nama);
    $('#alamat-faskes').html(`
                <h6>Alamat Faskes :</h6>
                <p>` +  _alamat + `</p>`);
    $('#website-faskes').html(`
                <h6>Situs Web :</h6>
                <p><a href="` + _website + `">` +  _website + `</a></p>`);
    mapFaskes(_nama, _alamat, _website, _koordinat);
    // console.log(_alamat);
    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'ketersediaan/detailFaskes',
        data : {
            nama : _nama,
        },
        success : function(response) {
            let faskes = response;
            console.log(faskes);
                        
            faskes.forEach(data => {

                $('#card-detail').append(`
                <div class="card mb-3">
                    <div class="card-body">
                        <h1 class="card-title">` + data.kelas + `</h1>
                        <p class="card-text">Kamar Tersedia</p>
                        <h2 class="card-text fw-lighter" id="ketersediaan">` + data.tersedia + `</h2>` +
                        ((data.updated_at !== null) ? 
                        `<p class="card-subtitle mt-2 fs-6 fw-light text-muted text-end">Update terakhir ` +  showElapsedTime(Date.parse(data.updated_at)) + ` yang lalu</p>
                    </div>
                </div>`
                        : `<p class="card-subtitle mt-2 fs-6 fw-light text-muted text-end">Update terakhir ` +  showElapsedTime(Date.parse(data.created_at)) + ` yang lalu</p>
                    </div>
                </div>`
                )
            );
            });
			$('#modal').on('shown.bs.tab', function () {
				map.invalidateSize();
				map.removeLayer(marker);
			})
            $('#modal').modal('show');
        }
    });
}

function modalKelas(_kelas) {
    // $('#map').html('');
    // $('#alamat-faskes').html('');
    // $('#website-faskes').html('');
    $('#card-detail-K').html('');
    // console.log(nama);
    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'ketersediaan/detailKelas',
        data : {
            kelas : _kelas,
        },
        success : function(response) {
            let kelas = response;
            console.log(kelas);
            $('#modal-head-K').html(kelas[0].kelas);
            kelas.forEach(data => {
                $('#card-detail-K').append(`
                <div class="card mb-3">
                    <div class="card-body">
                        <h1 class="card-title">` + data.nama + `</h1>
                        <p class="card-text">Kamar Tersedia</p>
                        <h2 class="card-text fw-lighter" id="ketersediaan">` + data.tersedia + `</h2>` +
                        ((data.updated_at !== null) ? 
                        `<p class="card-subtitle mt-2 fs-6 fw-light text-muted text-end">Update terakhir ` +  showElapsedTime(Date.parse(data.updated_at)) + ` yang lalu</p>
                    </div>
                </div>`
                        : `<p class="card-subtitle mt-2 fs-6 fw-light text-muted text-end">Update terakhir ` +  showElapsedTime(Date.parse(data.created_at)) + ` yang lalu</p>
                    </div>
                </div>`
                )
            );
            });
            $('#modal_K').modal('show');
        }
    });
}

function mapFaskes(_nama, _alamat, _website, _koordinat) {
    let koordinat = _koordinat;
    let latlong = koordinat.split(',');
    let latitude = latlong[0];
    let longitude = latlong[1];
	let popup = `
		<h5>`+ _nama +`</h5>
		<p><a href="`+ _website +`">`+ _website +`</a></p>
		<p>`+ _alamat +`<p>
	`;

	var container = L.DomUtil.get('map');
	if(container != null){
		container._leaflet_id = null;
	}
	
    // var map = L.map('map');
	// map.invalidateSize();
	map.setView([latitude, longitude], 16.5);
	
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
	
    marker = new L.marker([latitude, longitude]).addTo(map);
	map.addLayer(marker);
	marker.bindPopup(popup).openPopup();
}
