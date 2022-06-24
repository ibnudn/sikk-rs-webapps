<body style="background-color: rgba(173,216,230,0.5);">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<h1 class="card-title text-center display-5">Login</h1>
						<br>
                        <?= $this->session->flashdata('pesan'); ?>
						<form class="form-signin" action="<?= base_url('auth/login') ?>" method="POST">
							<div class="form-floating mb-3" id="inp-uname">
								<input type="text" class="form-control" id="input-username" placeholder="Username" name="username">
								<label for="input-username">Username</label>
							</div>
							<div class="form-floating" id="inp-pwd">
								<input type="password" class="form-control" id="input-password" placeholder="Password" name="password" id="password">
								<label for="input-password">Password</label>
							</div>
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
							<br>
							<div class="text-center">
								<button type="submit" class="btn btn-success">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
var err_uname = "<?= $this->session->flashdata('err_username'); ?>";
var err_pass = "<?= $this->session->flashdata('err_password'); ?>";
var uname_val = "<?= $this->session->flashdata('uname_val'); ?>";

$(document).ready(function() {
	var err_div_uname = "";
	var err_class_uname = "";
	if (err_uname != "") {
		console.log(err_uname);
		err_div_uname = `<div id="err_username" class="invalid-feedback">`+err_uname+`</div>`;
		err_class_uname = `is-invalid`;
		$('#inp-uname').append(err_div_uname);
		$('#input-username').addClass(err_class_uname);
	}
	
	console.log(err_pass);
	if (err_pass !="") {
		var cls = `<div id="err_password" class="invalid-feedback">`+err_pass+`</div>`;
		var inpInVld = `is-invalid`;
		$('#inp-pwd').append(cls);
		$('#input-username').val(uname_val);
		$('#input-password').addClass(inpInVld);
	}
});
</script>
