<!-- Main Content -->
<div id="content">

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Users</h6>
        </div>
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= validation_errors() ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <form action="<?= base_url('admin/c_users/edit_user/'. $user['id_user']); ?>" method="post">
                <div class="mb-3">
                    <label for="InputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="InputUsername" name="username" value="<?= $user['username'] ?>">
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" value="<?= $user['password'] ?>">
                </div>
                <div class="mb-3">
                    <label for="InputRole" class="form-label">Role</label>
                    <select class="form-select" id="InputRole" name="id_role">
                        <?php foreach($role as $row) : ?>
                            <option value="<?= $row['id_role']?>" <?= ($row['id_role'] == $user['id_role']) ? 'selected' : '' ?>>
                                <?= $row['nama_role']?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <a class="btn btn-secondary mx-3" href="<?= base_url('admin/c_users') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>  

</div>
