<!-- Begin Page Content -->
<div class="container-fluid mt-5">

<!-- 404 Error Text -->
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <div class="error mx-auto" data-text="403">403</div>
    <p class="display-6 text-gray-800 mb-5">Access Forbidden</p>
    <p class="lead text-gray-700 mb-1">Halaman yang dituju tidak dapat diakses</p>
    <?php if ($this->session->id_role == 1) : ?>
        <a href="<?= base_url('admin') ?>">&larr; Kembali ke Dashboard</a>
    <?php elseif ($this->session->id_role == 2) : ?>
        <a href="<?= base_url('pegawai') ?>">&larr; Kembali ke Dashboard</a>
    <?php else : ?>
        <a href="<?= base_url('auth') ?>">&larr; Kembali ke Halaman Login</a>
    <?php endif; ?>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
