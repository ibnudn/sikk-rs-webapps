<!-- Main Content -->
<div id="content">

<?= $this->session->flashdata('pesan'); ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('admin/c_kapasitas/tambah_kapasitas_faskes'); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah Kapasitas Faskes
</a>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kapasitas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($kapasitas as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $row['nama_faskes']?></strong></td>
                            <td><?= $row['kapasitas']?></td>
                            <td class="text-center">    
                                <a href="<?= base_url('admin/c_kapasitas/detail_kapasitas/'. $row['id_faskes']); ?>" class="btn btn-info" data-bs-toggle="tooltip" title="Detail Kapasitas"><i class="fas fa-fw fa-info"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>