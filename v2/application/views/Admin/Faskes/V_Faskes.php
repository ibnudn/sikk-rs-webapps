<!-- Main Content -->
<div id="content">
<div class="container mb-3">
    <h1 class="display-6 text-center text-gray-800">Daftar Faskes</h1>
</div>

<?= $this->session->flashdata('pesan'); ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('admin/c_faskes/tambah_faskes'); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah Faskes
</a>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Faskes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($faskes as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $row['nama_faskes']?></strong></td>
                            <td><?= $row['kategori_faskes']?></td>
                            <td><?= $row['tipe_faskes']?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/c_faskes/detail_faskes/'. $row['id_faskes']); ?>" class="btn btn-info"><i class="fas fa-fw fa-info"></i></a>
                                <a href="<?= base_url('admin/c_faskes/edit_faskes/'. $row['id_faskes']); ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('admin/c_faskes/hapus_faskes/'. $row['id_faskes']); ?>" class="btn btn-danger"  onclick="return confirm('Apakah anda ingin menghapus data <?= $row['nama_faskes'] ?>?');"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
