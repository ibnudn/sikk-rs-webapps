<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kapasitas Faskes</h6>
        </div>
        <div class="card-body">
            <?= validation_errors(); ?>
            <form action="<?= base_url('admin/c_kapasitas/tambah_kapasitas_faskes/'); ?>" method="post" id="form">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <table class="table table-hover">
                    <tr>
                        <td>Nama Faskes</td>
                        <td>
                            <select class="form-select" name="id_faskes" id="id_fakses">
                                <option selected disabled hidden>Faskes</option>
                                <?php foreach($faskes_kosong as $row) : ?>
                                    <option value="<?= $row['id_faskes']?>" data-tipe="<?= $row['id_tipe_faskes']?>"><?= $row['nama_faskes']?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="table table-hover" id="input_table">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <tr>
                            <td>
                                <select class="form-select" name="id_kelas[]" id="id_kelas">
                                    <option selected disabled hidden>Kelas</option>
                                    <?php foreach($kelas as $row) : ?>
                                        <option value="<?= $row['id_kelas']?>"><?= $row['nama_kelas']?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="kapasitas[]" min="0">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot id="table_footer">
                        <tr>
                            <td colspan="2" class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="addRow()">Tambah Kelas</button>
                                <button type="button" class="btn btn-sm btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('admin/c_kapasitas') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
// function addRow(){
//     $('#table_body').append(`
//     <tr>
//         <td>
//             <select class="form-select" name="id_kelas[]">
//                 <option selected disabled hidden>Kelas</option>
//                 <?php foreach($kelas as $row) : ?>
//                     <option value="<?= $row['id_kelas']?>"><?= $row['nama_kelas']?></option>
//                 <?php endforeach ?>
//             </select>
//         </td>
//         <td>
//             <input type="text" class="form-control" name="kapasitas[]">
//         </td>
//     </tr>
//     `);
// }

// function deleteRow() {
//     $("#table_body tr:last").remove();
// }

// $('#id_faskes').change(function(){ 
//     _id_faskes = this.value;
//     console.log(_id_faskes);
// });

document.getElementById('form').id_faskes.onchange = function() {
    let _id_faskes = this.value;
    let _id_tipe_faskes = $(this).find(':selected').data('tipe');
    console.log(_id_tipe_faskes);

    if (_id_tipe_faskes === 6) {
        // $('#table_body').html(`
        // <tr>
        //     <td>
        //         <select class="form-select" name="id_kelas[]" id="id_kelas">
        //             <option value="10" selected disabled>Puskesmas</option>
        //         </select>
        //     </td>
        //     <td>
        //         <input type="text" class="form-control" name="kapasitas[]">
        //     </td>
        // </tr>
        // `);
        $('#id_kelas').val("10").prop('disabled', true).change();
        $("#table_footer").empty();
    } else {
        $('#table_body').html(`
        <tr>
            <td>
                 <select class="form-select" name="id_kelas[]" id="id_kelas">
                     <option selected disabled hidden>Kelas</option>
                     <?php foreach($kelas as $row) : ?>
                         <option value="<?= $row['id_kelas']?>"><?= $row['nama_kelas']?></option>
                     <?php endforeach ?>
                 </select>
            </td>
            <td>
                 <input type="number" class="form-control" name="kapasitas[]" min="0">
            </td>
         </tr>
        `);
        $("#table_footer").html(`
        <tr>
            <td colspan="2" class="text-center">
                <button type="button" class="btn btn-outline-primary mb-3" onclick="addRow()">Tambah Kelas</button>
                <button type="button" class="btn btn-outline-danger mb-3" onclick="deleteRow()">Hapus Kelas</button>
            </td>
        </tr>
        `);
    }
}

$('#form').on('submit', function() {
    $('#id_kelas').prop('disabled', false);
});


</script>

