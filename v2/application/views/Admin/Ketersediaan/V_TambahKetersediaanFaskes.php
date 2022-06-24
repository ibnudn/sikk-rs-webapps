<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Ketersediaan Faskes</h6>
        </div>
        <div class="card-body">
            <?= validation_errors(); ?>
            <form action="<?= base_url('admin/c_ketersediaan/tambah_ketersediaan_faskes/'); ?>" method="post" id="form">
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
                            <th>Ketersediaan</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                </table>
                <div class="row">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('admin/c_ketersediaan') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
var base_url = "<?= base_url('admin/c_ketersediaan/'); ?>";

// $('#id_faskes').change(function(){ 
//     _id_faskes = this.value;
//     console.log(_id_faskes);
// });

document.getElementById('form').id_faskes.onchange = function() {
    let _id_faskes = this.value;

    $('#table_body').html('');

    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'kapasitas_faskes__',
        data : {
            id_faskes : _id_faskes
        },
        success : function(response) {
            console.log(response);
            response.forEach(data => {
                $('#table_body').append(`
                    <tr>
                        <td>
                            <input type="hidden" name="id_kelas[]" value="`+ data.id_kelas +`">
                            `+ data.nama_kelas +`
                        </td>
                        <td>
                            <input type="hidden" name="kapasitas[]" value="`+ data.kapasitas +`">
                            `+ data.kapasitas +`
                        </td>
                        <td>
                            <input type="text" class="form-control" name="ketersediaan[]">
                        </td>
                    </tr>
                `);
            })
        }
    });
}
</script>

