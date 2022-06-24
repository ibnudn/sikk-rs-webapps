<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Users</h6>
        </div>
        <?= $this->session->flashdata('pesan'); ?>
        <div class="card-body">
            <form action="<?= base_url('admin/c_users/tambah_user'); ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
					<div id="err_username"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
					<div id="err_password"></div>
                </div>
                <div class="mb-3">
                    <label for="id_role" class="form-label">Role</label>
                    <select class="form-select" id="id_role" name="id_role">
						<option selected disabled hidden>Role User</option>
                        <?php foreach($role as $row) : ?>
                            <option value="<?= $row['id_role']?>"><?= $row['nama_role']?></option>
                        <?php endforeach ?>
                    </select>
					<div id="err_id_role"></div>
                </div>
				<input type="hidden" name="<?=$token_name?>" value="<?=$token_hash?>" />
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <a class="btn btn-secondary mx-3" href="<?= base_url('admin/c_users') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
var errMsg = <?php print_r($err) ?>;
var oldVal = <?php print_r($oldVal); ?>;
Object.keys(errMsg).forEach((data) => {
	console.log(oldVal[data]);
	if (errMsg[data]) {
		$('#'+data).addClass('is-invalid');
		$('#err_'+data).addClass('invalid-feedback');
		$('#err_'+data).html(errMsg[data]);
	}
	if (oldVal[data]) {
		$('#'+data).val(oldVal[data]);
	}
});
</script>
