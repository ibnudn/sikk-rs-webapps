<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Ketersediaan <?= $ketersediaan[0]['nama_faskes'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/c_ketersediaan/tambah_ketersediaan/'. $ketersediaan[0]['id_faskes']); ?>" method="post" id="form-tambah">
            	<input type="hidden" name="<?=$token_name;?>" value="<?=$token_hash;?>" />    
				<input type="hidden" name="id_faskes" value="<?= $ketersediaan[0]['id_faskes'] ?>">
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
                    <button type="submit" class="btn btn-primary" id="submit">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('admin/c_ketersediaan/detail_ketersediaan/'. $ketersediaan[0]['id_faskes']) ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
var base_url = "<?= base_url('admin/c_ketersediaan/'); ?>";
let _id_faskes = <?= $ketersediaan[0]['id_faskes'] ?>;
var errMsg = <?php print_r($err); ?>;
var oldVal = <?php print_r($inputKetersediaan); ?>;

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
// $('#table_body').html('');
// $( document ).ready(function() {
//     console.log( "ready!" );
//     $.ajax({
//         method : 'GET',
//         dataType : 'json',
//         url : base_url + 'kapasitas__',
//         data : {
//             id_faskes : _id_faskes
//         },
//         success : function(response) {
//             console.log(response);
//             if(!$.trim(response)) {
// 				$('#table_body').append(`
// 					<tr class="text-center bg-gray-300">
// 						<td colspan="3">Data kapasitas belum terisi</td>
// 					</tr>
// 				`);
// 				$('#submit-btn').html('');
// 			} else {
// 				Object.keys(response).forEach(data => {
// 					$('#table_body').append(`
// 						<tr>
// 							<td>
// 								<input type="hidden" name="id_kelas[]" value="`+ response[data].id_kelas +`">
// 								`+ response[data].nama_kelas +`
// 							</td>
// 							<td>
// 								<input type="hidden" name="kapasitas[]" value="`+ response[data].kapasitas +`">
// 								`+ response[data].kapasitas +`
// 							</td>
// 							<td>
// 								<div class="input-group has-validation">
// 									<input type="text" class="form-control" name="ketersediaan[]" id="ketersediaan">
// 									<div id="err_mssg"></div>
// 								</div>
// 							</td>
// 						</tr>
// 					`);
// 				})
// 			}
//         }
//     }); 

// });
// $( document ).ready(function() {
// 	$('#submit').click(function(e) {
// 		e.preventDefault();
	
// 		var id_faskes = <?= $ketersediaan[0]['id_faskes'] ?>;
// 		var dataString = $("#form-tambah").serializeArray();
// 		// console.log(dataString);
// 		$.ajax({
// 			type: "POST",
// 			url: base_url + 'tambah_ketersediaan/' + id_faskes,
// 			data: dataString,
// 			success: function(data) {
// 				//and from data parse your json data and show error message in the modal
// 				console.log(data);
// 				if(data!='')
// 				{                             
// 					var obj = $.parseJSON(data);
// 					console.log(obj['error_message']);
// 					// $('#form-tambah').addClass('was-validated');
// 					$('#ketersediaan').addClass('is-invalid');
// 					$('#err_mssg').addClass('invalid-feedback');
// 					$('#err_mssg').append(obj['error_message']);
// 				} else {
// 					location.reload();
// 				}
// 			}
// 		});
// 	});
// });
</script>
