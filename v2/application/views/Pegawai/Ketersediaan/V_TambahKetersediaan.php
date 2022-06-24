<!-- Main Content -->
<div id="content">
    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="card-title">Tambah Ketersediaan <?= $faskes['nama_faskes'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pegawai/c_ketersediaan/tambah_ketersediaan/'. $faskes['id_faskes']); ?>" method="post">
            	<input type="hidden" name="<?=$token_name;?>" value="<?=$token_hash;?>" />    
				<input type="hidden" name="id_faskes" value="<?= $faskes['id_faskes'] ?>">
                <table class="table table-hover" id="input_table">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                            <th>Ketersediaan</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                </table>
                <div class="row" id="submit-btn">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('pegawai/c_ketersediaan/') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
var base_url = "<?= base_url('pegawai/c_ketersediaan/'); ?>";
let _id_faskes = <?= $this->session->id_faskes; ?>;
var errMsg = <?php print_r($err); ?>;
var oldVal = <?php print_r($inputKetersediaan); ?>;

// $('#table_body').html('');
$( document ).ready(function() {
	console.log( "ready!" );
	$.ajax({
		method : 'GET',
		dataType : 'json',
		url : base_url + 'kapasitas__',
		data : {
			id_faskes : _id_faskes
		},
		success : function(response) {
			if(!$.trim(response)) {
				$('#table_body').append(`
					<tr class="text-center bg-gray-300">
						<td colspan="3">Data kapasitas belum terisi</td>
					</tr>
				`);
				$('#submit-btn').html('');
			} else {
				var i = 0;
				var cls = "";
				var inpInVld = [];
				// console.log(errMsg);
				Object.keys(response).forEach(data => {
					if(!response.length === 0){
						console.log("mas");
						// return;
					}
					// if(errMsg && errMsg.length > 0){
					// 	errMsg.forEach(function(v,k){
					// 		if(k == i){
					// 			cls = `<div id="err_mssg[`+i+`]" class="invalid-feedback">`+v+`</div>`;
					// 			inpInVld[i] = `is-invalid`;
					// 		}
					// 	});
					// }
					if(errMsg && errMsg.length > 0){
						if(errMsg[i] != ''){
							cls = `<div id="err_mssg[`+i+`]" class="invalid-feedback">`+errMsg[i]+`</div>`;
							inpInVld[i] = `is-invalid`;
						}
					}
					var valx = "";
					if(oldVal && oldVal[i].length){
						valx = oldVal[i];
					}
					$('#table_body').append(`
					<tr>
						<td>
							<input type="hidden" name="id_kelas[]" value="`+ response[data].id_kelas +`">
						`+ response[data].nama_kelas +`
						</td>
						<td>
							<input type="hidden" name="kapasitas[]" value="`+ response[data].kapasitas +`">
						`+ response[data].kapasitas +`
						</td>
						<td>
							<input type="number" class="form-control `+inpInVld[i]+`" name="ketersediaan[`+i+`]" id="ketersediaan[`+i+`]" value="`+valx+`" min="0">`+cls+`
						</td>
					</tr>
					`);
					i++;
				});
				// console.log(inpInVld);
			}
		}
	}); 
});

</script>
