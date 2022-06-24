<!-- Main Content -->
<div id="content">

    <div class="container mb-3">
    </div>

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Fasilitas Kesehatan</h6>
        </div>
        <?= validation_errors(); ?>
        <div class="card-body">
            <form action="<?= base_url('admin/c_faskes/edit_faskes/'. $faskes['id_faskes']); ?>" method="post">
			<input type="hidden" name="<?=$token_name;?>" value="<?=$token_hash;?>" />
                <table class="table table-hover">
                    <tr>
                        <th>Nama</th>
                        <td>
							<input type="text" class="form-control" name="nama" id="nama" value="<?= $faskes['nama_faskes'] ?>">
							<div id="err_nama"></div>
						</td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td>
							<select class="form-select" name="tipe" id="tipe">
								<?php foreach($tipe as $row) : ?>
									<option value="<?= $row['id_tipe_faskes']?>" <?= ($row['id_tipe_faskes'] == $faskes['id_tipe_faskes']) ? 'selected' : '' ?>>
										<?= $row['tipe_faskes']?>
									</option>
								<?php endforeach ?>
							</select>
							<div id="err_tipe"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>
							<textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $faskes['alamat_faskes'] ?></textarea>
							<div id="err_alamat"></div>
						</td>
                    </tr>
					<tr>
                        <th>Situs Web</th>
                        <td>
							<input class="form-control" name="website" id="website"></input>
							<div id="err_website"></div>
						</td>
                    </tr>
                    <tr>
                        <th rowspan="2">Koordinat</th>
                        <td>
							<input type="text" class="form-control" name="koordinat" id="koordinat" value="<?= $faskes['koordinat_faskes'] ?>">
							<div id="err_koordinat"></div>
						</td>
                    </tr>
                    <tr>
                        <td>
                            <div id="map"></div>
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('admin/c_faskes') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
/*
* ------------------- MAP -------------------------------
*/
    let koordinat = "<?php echo($faskes['koordinat_faskes']) ?>";
    let latlong = koordinat.split(',');
    let latitude = latlong[0];
    let longitude = latlong[1];

    var map = L.map('map').setView([latitude, longitude], 16.5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = new L.marker([latitude, longitude], {draggable: true}).addTo(map);

    var onClick = function(e) {
        marker.setLatLng(e.latlng);
        var koordinat = e.latlng.lat + "," + e.latlng.lng
        document.getElementById('koordinat').value = koordinat;
    };

    map.on('click', onClick);
    
    marker.on('dragend', function (e) {
        let latitude = marker.getLatLng().lat;
        let longitude = marker.getLatLng().lng;
        var koordinat = latitude + "," + longitude;
        console.log(koordinat);
        document.getElementById('koordinat').value = koordinat;
    });
// ----------------------------------------

var errMsg = <?php print_r($err) ?>;
var oldVal = <?php print_r($oldVal); ?>;
Object.keys(errMsg).forEach((data) => {
	console.log(oldVal[data]);
	if (errMsg[data]) {
		$('#'+data).addClass('is-invalid');
		$('#err_'+data).addClass('invalid-feedback');
		$('#err_'+data).html(errMsg[data]);
	}
	if (oldVal[data]) {
		$('#'+data).val(oldVal[data]);
	}
});
</script>
