<!-- Main Content -->
<div id="content">

<div class="container mb-3">
    <h1 class="display-6 text-center text-gray-800">Detail Kapasitas</h1>
    <h1 class="display-5 text-center text-gray-800"><?= $kapasitas[0]['nama_faskes'] ?></h1>
</div>

<?= $this->session->flashdata('pesan'); ?>
<?php if ($faskes['id_tipe_faskes'] !== "6") : ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('pegawai/c_kapasitas/tambah_kapasitas/'.$kapasitas[0]['id_faskes']); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah Kapasitas
</a>
<?php endif ?>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Kapasitas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($kapasitas as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $row['nama_kelas']?></strong></td>
                            <td><?= $row['kapasitas']?></td>
                            <td class="text-center">
                            <button type="button" class="btn btn-info" onclick="modalRiwayat('<?= $row['id_faskes'] ?>', '<?= $row['id_kelas'] ?>')" data-bs-toggle="tooltip" title="Riwayat Kapasitas">
                                <i class="fas fa-fw fa-history"></i>
                            </button>
                            <button type="button" class="btn btn-info" onclick="modalInput('<?= $row['id_faskes'] ?>', '<?= $row['id_kelas'] ?>', '<?= $row['kapasitas'] ?>')" data-bs-toggle="tooltip" title="Update Kapasitas">
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
                            <th>Kapasitas</th>
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
                <form action="<?= base_url('pegawai/c_kapasitas/update_kapasitas/'.$kapasitas[0]['id_faskes']); ?>" method="post">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>"/>
					<table class="table table-hover">
                        <tr>
                            <th>Kapasitas Sekarang</th>
                            <td id="kapasitas_now"></td>
                        </tr>
                        <tr>
                            <th>Kapasitas Baru</th>
                            <td>
                                <input type="hidden" class="form-control" name="id_faskes" id="id_faskes">
                                <input type="hidden" class="form-control" name="id_kelas[]" id="id_kelas">
                                <input type="text" class="form-control" name="kapasitas[]">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary align-self-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let base_url = "<?= base_url('pegawai/c_kapasitas/') ?>";

function modalRiwayat(_faskes, _kelas) {
    $("#detail-table tbody").empty();
    
    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'riwayat_kapasitas',
        data : {
            id_faskes : _faskes,
            id_kelas : _kelas,
        },
        success : function(response) {
            let riwayat = response;
            $('#title1').html(`
            <h5>Riwayat Kapasitas ` + riwayat[0].nama_kelas + ` pada ` + riwayat[0].nama_faskes + `</h5>
            `);
            let no = 1;
            riwayat.forEach(data => {
                console.log(data);
                $('#detail-table tbody').append(`
                    <tr>
                        <td>` + no + `</td>
                        <td><strong>` + data.data_kapasitas + `</strong></td>
                        <td>` + data.waktu + `</td>
                    </tr>
                `);
                no++;
            });
            $('#modal1').modal('show');
        }
    });
}

function modalInput(_id_faskes, _id_kelas, _kapasitas_skrng) {
    $("#kapasitas_now").html(_kapasitas_skrng);
    $("#id_faskes").val(_id_faskes);
    $("#id_kelas").val(_id_kelas);

    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'riwayat_kapasitas',
        data : {
            id_faskes : _id_faskes,
            id_kelas : _id_kelas,
        },
        success : function(response) {
            let riwayat = response;
            $('#title2').html(`
            <h5>Update Kapasitas ` + riwayat[0].nama_kelas + ` pada ` + riwayat[0].nama_faskes + `</h5>
            `);
        }
    });
    $('#modal2').modal('show');
}
</script>
