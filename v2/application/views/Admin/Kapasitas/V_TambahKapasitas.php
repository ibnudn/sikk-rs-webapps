<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kapasitas <?= $kapasitas[0]['nama_faskes'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/c_kapasitas/tambah_kapasitas/'. $kapasitas[0]['id_faskes']); ?>" method="post">
			<input type="hidden" name="<?=$token_name;?>" value="<?=$token_hash;?>" />
				<table class="table table-hover" id="input_table">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <!-- <tr>
                            <td>
                                <select class="form-select" name="id_kelas[]">
                                    <option selected disabled hidden>Kelas</option>
                                    <?php //foreach ($kapasitas_kosong as $row) : ?>
                                            <option value="<?= $row['id_kelas']?>"><?= $row['nama_kelas']?></option>
                                    <?php //endforeach ?>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" name="id_faskes" value="<?= $kapasitas[0]['id_faskes'] ?>">
                                <input type="text" class="form-control" name="kapasitas[]">
                            </td>
                        </tr> -->
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td colspan="2" class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="addRow()">Tambah Kelas</button>
                                <button type="button" class="btn btn-sm btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>
                            </td>
                        </tr>
                    </tfoot> -->
					<?php if($faskes['id_tipe_faskes'] != 6) : ?>
                    <tfoot id="table_foot">
                        
                    </tfoot>
					<?php endif; ?>
                </table>
                <button type="submit" class="btn btn-primary align-self-end">Submit</button>
            </form>
        </div>
    </div>

    <a class="btn btn-secondary mx-3" href="<?= base_url('admin/c_kapasitas/detail_kapasitas/'. $kapasitas[0]['id_faskes']) ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">


// function deleteRow() {
//     $("#table_body tr:last").remove();
// }

const cons_styles = [
  'color: navy',
  'background: white',
  'font-size: 30px',
  'border: 1px solid navy',
  'padding: 10px',
].join(';');

var base_url = "<?= base_url('admin/c_kapasitas/'); ?>";
let faskes = <?= json_encode($faskes); ?>;
let _id_faskes = faskes.id_faskes;
var errMsg = <?php print_r($err); ?>;
var oldKel = <?php print_r($inputKelas); ?>;
var oldKap = <?php print_r($inputKapasitas); ?>;
console.log(_id_faskes);

$( document ).ready(function() {
	console.log("%cReady!", cons_styles);
	$.ajax({
		method : 'GET',
		dataType : 'json',
		url : base_url + 'kapasitas__',
		data : {
			id_faskes : _id_faskes
		},
		success : function(response) {
			console.log(response);
			if(!$.trim(response)) {
				// console.log("fail");
			} else {
				var i = 0;
				var opt = [];
				var inp = [];
				var err_kap_ = "";
				var inv_kap_ = [];
				var val_kap = "";
				var tfoot = "";
				console.log(errMsg);
				
				if(faskes['id_tipe_faskes'] == 6){
					if(errMsg && Object.keys(errMsg).length > 0){
						if(errMsg.kapasitas[i] != ''){
							err_kap_ = `<div id="err_kap[`+i+`]" class="invalid-feedback">`+errMsg.kapasitas[i]+`</div>`;
							inv_kap_[i] = `is-invalid`;
						}
					}
					if(oldKap && oldKap[i].length){
						val_kap = oldKap[i];
					}
					opt = `<input type="hidden" name="id_kelas[`+i+`]" value="`+ response[9].id_kelas +`">`;
					inp = `<input type="number" class="form-control `+inv_kap_[i]+`" name="kapasitas[`+i+`]" id="kapasitas[`+i+`]" value="`+val_kap+`" min="0">`+err_kap_;

					$('#table_body').append(`<tr><td id="_select"></td><td id="_input"></td></tr>`);
					$('#_select').append(response[9].nama_kelas + opt);
					$('#_input').append(inp);
					
				} else {
					delete response[9];
					i = 0;
					
					if (!oldKap) {
						j = 1;

						$('#table_body').append(formRow(response, errMsg, oldKel, oldKap, i));

						var btn_add = $(`<button type="button" class="btn btn-sm btn-outline-primary mb-3">Tambah Kelas</button>`);
						var btn_del = $(`<button type="button" class="btn btn-sm btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>`);
						btn_add.click(function() {
							addRow(response, errMsg, oldKel, oldKap, j);
							j++;
						});
					} else {
						j = oldKap.length;
						console.log(oldKap.length);
						for(var x=0; x < oldKap.length; x++) {
							$('#table_body').append(formRow(response, errMsg, oldKel, oldKap, x));
						}
						var btn_add = $(`<button type="button" class="btn btn-sm btn-outline-primary mb-3">Tambah Kelas</button>`);
						var btn_del = $(`<button type="button" class="btn btn-sm btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>`);
						btn_add.click(function() {
							addRow(response, errMsg, oldKel, oldKap, j);
							j++;
						});
					}

					// console.log(`addRow(`+ response +`)`);
					// tfoot = `
					// <tr>
					// 	<td colspan="2" class="text-center">
					// 		<button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="addRow(`+ response +`)">Tambah Kelas</button>
					// 		<button type="button" class="btn btn-sm btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>
					// 	</td>
					// </tr>`;
					tfoot = `
					<tr>
						<td colspan="2" class="text-center" id="tfoot_content">
						</td>
					</tr>`;
					
					$('#table_foot').append(tfoot);
					$('#tfoot_content').append(btn_add).append(btn_del);
				}
				// $('#table_body').append(`
				// <tr>
				// <td>
				// <select class="form-select" name="id_kelas[]" ` + sel + `>` + opt +  `</select>
				// </td>
				// <td>`+inp+`
				// </td>
				// </tr>
				// `);
			}
		}
	}); 
});

function formRow(response, error_message, class_value, capacity_value, i) {
	var y = 0;
	var opt = [];
	var inp = [];
	var err_kap_ = "";
	var inv_kap_ = [];
	var val_kap = "";
	var err_kel_ = "";
	var inv_kel_ = [];
	var val_kel = "";
	var sel = [];

	// console.log(i);
	
	$('#table_body').append(`<tr data-num="`+i+`"><td id="_select_`+i+`"></td><td id="_input_`+i+`"></td></tr>`);
	// console.log($('#table_body tr:last').attr('data-num'));
	
	if(error_message && Object.keys(error_message).length > 0) {
		// console.log(Object.keys(error_message.kapasitas));
		if((error_message.kapasitas[i] != null) && (error_message.kapasitas[i] != "")){
			console.log(error_message.kapasitas);
			err_kap_ = `<div id="err_kap[`+i+`]" class="invalid-feedback">`+error_message.kapasitas[i]+`</div>`;
			inv_kap_[i] = `is-invalid`;
		}
		if((error_message.kelas[i] != null) && (error_message.kelas[i] != "")){
			err_kel_ = `<div id="err_kel[`+i+`]" class="invalid-feedback">`+error_message.kelas[i]+`</div>`;
			inv_kel_[i] = `is-invalid`;
		}
	}
	// console.log(class_value);
	// console.log(capacity_value);
	if(capacity_value && capacity_value[i]){
		val_kap = capacity_value[i];
	}
	if (class_value && class_value[i]) {
		val_kel = class_value[i];
	}

	inp = `<input type="number" class="form-control `+inv_kap_[i]+`" name="kapasitas[`+i+`]" id="kapasitas[`+i+`]" value="`+val_kap+`" min="0">`+err_kap_;
	
	$('#_select_'+i).append(`
	<select class="form-select `+inv_kel_[i]+`" name="id_kelas[`+i+`]" id="__kelas_`+i+`">
		<option selected value="" hidden>Kelas</option>
		</select>`+err_kel_);

	Object.keys(response).forEach(data => {
		// console.log(response[data]);($Defaultselection == 1)?"selected":"";
		if (val_kel == response[data].id_kelas) {
			sel[i] = "selected";
		} else { 
			sel[i] = ""
		}
		opt[y] = `<option value="`+ response[data].id_kelas +`" ` + sel[i] + `>`+ response[data].nama_kelas +`</option>`;
		// console.log(opt[i]);
		y++;
	});
	
	console.log(opt);
	$('#__kelas_'+i).append(opt);
	// $('#_select').append(`</select>`+err_kel_);
	$('#_input_'+i).append(inp);
}

function addRow(response, error_message, class_value, capacity_value, i){
	var newRow = formRow(response, error_message, class_value, capacity_value, i);
	$('#table_body').append(newRow);
}

function deleteRow() {
	$("#table_body tr:last").remove();
}
</script>
