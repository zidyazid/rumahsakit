<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $judul; ?>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<?php if (validation_errors()) : ?>
							<div class="alert alert-danger" role="alert">
								<?= validation_errors(); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="box-body">
						<form action="<?= base_url('data_pasien/ubah/' . $pasien['nik']) ?>" method="post">
							<div class="form-group row">
								<label for="nik" class="col-sm-2 col-form-label">Nik</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['nik'] ?>" type="text" class="form-control" id="nik" name="nik" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="nama" class="col-sm-2 col-form-label">Nama</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['nama'] ?>" type="text" class="form-control" id="nama" name="nama" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['alamat'] ?>" type="text" class="form-control" id="alamat" name="alamat" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['tanggal_lahir'] ?>" type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="golongan" class="col-sm-2 col-form-label">Golongan</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['golongan'] ?>" type="text" class="form-control" id="golongan" name="golongan" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="umur" class="col-sm-2 col-form-label">Umur</label>
								<div class="col-sm-10">
									<input value="<?= $pasien['umur'] ?>" type="text" class="form-control" id="umur" name="umur" value="">
								</div>
							</div>
							<div class="">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>