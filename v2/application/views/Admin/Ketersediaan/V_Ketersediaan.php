<!-- Main Content -->
<div id="content">

<?= $this->session->flashdata('pesan'); ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('admin/c_ketersediaan/tambah_ketersediaan_faskes'); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah Ketersediaan Faskes
</a>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Ketersediaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
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
                            <td><strong><?= $row['nama_faskes']?></strong></td>
                            <td><?= $row['kapasitas']?></td>
                            <td><?= $row['ketersediaan']?></td>
                            <td class="text-center">    
                                <a href="<?= base_url('admin/c_ketersediaan/detail_ketersediaan/'. $row['id_faskes']); ?>" class="btn btn-info" data-bs-toggle="tooltip" title="Detail ketersediaan"><i class="fas fa-fw fa-info"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>