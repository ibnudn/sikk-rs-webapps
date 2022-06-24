<!-- Main Content -->
<div id="content">

<div class="container mb-3">
    <h1 class="display-6 text-center text-gray-800">Daftar User</h1>
</div>

<?= $this->session->flashdata('pesan'); ?>
<a class="btn btn-primary ms-3 my-2" href="<?= base_url('admin/c_users/tambah_user'); ?>" role="button">
    <i class="fas fa-fw fa-plus"></i> Tambah User
</a>

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($user as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['username']?></td>
                            <td><?= $row['nama_role']?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/c_users/edit_user/'. $row['id_user']); ?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Edit User"><i class="fas fa-fw fa-edit"></i></a>
								<?php if ($row['nama_role'] == "Pegawai") : ?>
									<button type="button" class="btn btn-info" data-bs-toggle="tooltip" title="Detail Pegawai" onclick="modalPegawai('<?=$row['id_user']?>', '<?= $row['username']?>')"><i class="fas fa-fw fa-info"></i></button>
								<?php endif ?>
                                <a href="<?= base_url('admin/c_users/hapus_user/'. $row['id_user']); ?>" class="btn btn-danger" data-bs-toggle="tooltip" title="Hapus User" onclick="return confirm('Apakah anda yakin akan menghapus user <?= $row['username']?>?');"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title1"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="detail-title"></div>
                <table class="table table-bordered" id="detail-table" width="100%" cellspacing="0">
					<tr>
                        <th>Username</th>
                        <td id="username"></td>
                    </tr>
                    <tr>
                        <th>Faskes</th>
                        <td id="nama_faskes"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
let base_url = "<?= base_url('admin/c_users/') ?>";
let faskes = <?= $faskes ?>;
console.log(faskes);

function modalPegawai(_id_user, _username) {
    $("#title1").empty();
    $("#username").empty();
    $("#nama_faskes").empty();
    
	$('#title1').html(`
		<h5>User Pegawai ` + _username + `</h5>
	`);
	$("#username").html(_username);

    $.ajax({
        method : 'GET',
        dataType : 'json',
        url : base_url + 'pegawai',
        data : {
            id_user : _id_user
        },
        success : function(response) {
            if (!response) {
                console.log('data blom ada');
				$("#nama_faskes").html(`
					<form action="<?= base_url('admin/c_users/tambah_pegawai/'); ?>" method="post" id="form">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
						<input type="hidden" name="id_user" value="`+_id_user+`"/>
						<select class="form-select" name="id_faskes" id="id_faskes">
							<option selected disabled hidden>Faskes</option>
							
						</select>
					</form>
				`);
				$.each(faskes, function (index, val) { 
					// console.log(val);
					console.log(val.nama_faskes);
					$("#id_faskes").append(`
						<option value="`+ val.id_faskes +`" data-tipe="`+ val.id_tipe_faskes +`">`+ val.nama_faskes +`</option>
					`);
					// $('#id_faskes').append($('<option>',
					// 	{
					// 		value: val.id_faskes,
					// 		text : val.nama_faskes
					// 	})
					// );
					// $("id_faskes").append(new Option(val.nama_faskes, val.id_faskes));
				})
				$("#form").append(`
					<button type="submit" class="btn btn-sm btn-primary mt-2">SUBMIT</button>
				`);

            } else {
                let data = response;
                console.log(data);
    
                $("#nama_faskes").html(data.nama_faskes);
            }
        }
    });
	$('#modal').modal('show');
}
</script>

