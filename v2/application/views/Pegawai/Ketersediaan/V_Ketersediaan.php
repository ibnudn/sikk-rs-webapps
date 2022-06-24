<!-- Main Content -->
<div id="content">

<div class="container mb-3">
    <h1 class="display-6 text-center text-gray-800">Detail Ketersediaan</h1>
    <h1 class="display-5 text-center text-gray-800"><?= $ketersediaan[0]['nama_faskes'] ?></h1>
</div>

<?= $this->session->flashdata('pesan'); ?>
<?php if ($faskes['id_tipe_faskes'] !== "6") : ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('pegawai/c_ketersediaan/tambah_ketersediaan/'.$ketersediaan[0]['id_faskes']); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah Ketersediaan
</a>
<?php endif ?>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Ketersediaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                            <th>Ketersediaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($ketersediaan as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $row['nama_kelas']?></strong></td>
                            <td><?= $row['kapasitas']?></td>
                            <td><strong><?= $row['ketersediaan']?></strong></td>
                            <td class="text-center">
                            <button type="button" class="btn btn-info" onclick="modalRiwayat('<?= $row['id_faskes'] ?>', '<?= $row['id_kelas'] ?>')" data-bs-toggle="tooltip" title="Riwayat Ketersediaan">
                                <i class="fas fa-fw fa-history"></i>
                            </button>
                            <button type="button" class="btn btn-info" onclick="modalInput('<?= $row['id_faskes'] ?>', '<?= $row['id_kelas'] ?>', '<?= $row['ketersediaan'] ?>', '<?= $row['kapasitas']?>')" data-bs-toggle="tooltip" title="Update Ketersediaan">
                                <i class="fas fa-fw fa-pen"></i>
                            </button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title1"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="detail-title"></div>
                <table class="table table-bordered" id="detail-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ketersediaan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title2"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pegawai/c_ketersediaan/update_ketersediaan/'.$ketersediaan[0]['id_faskes']); ?>" method="post" id="form_update">
                <!-- <form method="post" id="form_update"> -->
                    <table class="table table-hover">
                            <tr>
                                <th>Kapasitas</th>
                                <td id="kapasitas1"></td>
                                <input type="hidden" class="form-control" name="kapasitas" id="kapasitas2">
                            </tr>
                        <tr>
                            <th>Ketersediaan Sekarang</th>
                            <td id="ketersediaan_now"></td>
                        </tr>
                        <tr>
                            <th>Ketersediaan Baru</th>
                            <td>
                                <input type="hidden" class="form-control" name="id_faskes" id="id_faskes">
                                <input type="hidden" class="form-control" name="id_kelas[]" id="id_kelas">
								<div class="input-group has-validation">
									<input type="text" class="form-control" name="ketersediaan[]" id="ketersediaan">
									<div id="err_mssg"></div>
								</div>
                            </td>
                        </tr>
						<tr></tr>
                    </table>
					<input type="hidden" name="<?= $token_name; ?>" value="<?= $token_hash; ?>" />
                    <button type="submit" class="btn btn-primary align-self-end" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let base_url = "<?= base_url('pegawai/c_ketersediaan/') ?>";
let token_name = "<?= $token_name; ?>";
let token_hash = "<?= $token_hash; ?>";


function modalRiwayat(_faskes, _kelas) {
    $("#detail-table tbody").empty();
    
    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'riwayat_ketersediaan',
        data : {
            id_faskes : _faskes,
            id_kelas : _kelas,
        },
        success : function(response) {
            let riwayat = response;
            $('#title1').html(`
            <h5>Riwayat Ketersediaan ` + riwayat[0].nama_kelas + ` pada ` + riwayat[0].nama_faskes + `</h5>
            `);
            let no = 1;
            riwayat.forEach(data => {
                // console.log(data);
                $('#detail-table tbody').append(`
                    <tr>
                        <td>` + no + `</td>
                        <td><strong>` + data.data_ketersediaan + `</strong></td>
                        <td>` + data.waktu + `</td>
                    </tr>
                `);
                no++;
            });
            $('#modal1').modal('show');
        }
    });
}

function modalInput(_id_faskes, _id_kelas, _ketersediaan_skrng, _kapasitas) {
    $("#ketersediaan_now").html(_ketersediaan_skrng);
    $("#kapasitas1").html(_kapasitas);
    $("#kapasitas2").val(_kapasitas);
    $("#id_faskes").val(_id_faskes);
    $("#id_kelas").val(_id_kelas);

    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'riwayat_ketersediaan',
        data : {
            id_faskes : _id_faskes,
            id_kelas : _id_kelas,
        },
        success : function(response) {
            let riwayat = response;
            $('#title2').html(`
            <h5>Update Ketersediaan ` + riwayat[0].nama_kelas + ` pada ` + riwayat[0].nama_faskes + `</h5>
            `);
			$('input[name="'+token_name+'"]').val(token_hash);
			// $('#form_update').append(`<input type="hidden" name="`+token_name+`" value="`+token_hash+`" />`);
        }
    });
    $('#modal2').modal('show');
}

// $(document).on("click", "#submit", function () {
//     var dataString = $("#form_update").serialize();
//     $.ajax({
//         type: "POST",
//         url: base_url + 'update_ketersediaan',
//         data: dataString,
//         success: function(data) {
//             //and from data parse your json data and show error message in the modal
//             var obj = $.parseJSON(data);
//             if(obj!=null)
//             {                             
//                 $('#err_mssg').html(obj['error_message']);
//             }
//         }
//     });
// });


$(document).ready(function() {
    $('#submit').click(function(e) {
        e.preventDefault();
		$('#ketersediaan').removeClass('is-invalid');
		$('#err_mssg').removeClass('invalid-feedback');
		$('#err_mssg').html('');

        var id_faskes = <?= $ketersediaan[0]['id_faskes'] ?>;
        var dataString = $("#form_update").serializeArray();
        // console.log(dataString);
        $.ajax({
            type: "POST",
            url: base_url + 'update_ketersediaan/' + id_faskes,
            data: dataString,
            success: function(data) {
                //and from data parse your json data and show error message in the modal
				// console.log(data);
                if(data!='')
                {                             
					var obj = $.parseJSON(data);
					// console.log(obj['error_message']);
					// $('#form_update').addClass('was-validated');
					// $('#form_update').append(`<input type="hidden" name="`+token_name+`" value="`+token_hash+`" />`);
					$('input[name="'+obj.token_name+'"]').val(obj.token_hash);
					$('#ketersediaan').addClass('is-invalid');
					$('#err_mssg').addClass('invalid-feedback');
                    $('#err_mssg').html(obj['error_message']);
                } else {
					location.reload();
				}
            }
        });
    });
});
</script>
