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
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">

					<div class="box-body">



						<form action="<?= base_url('obat_masuk/updateObatMasuk/' . $dataDipilih["id_transaksi"]); ?>" method="post">
							<div class="form-group row">
								<label for="kode_obat" class="col-sm-2 col-form-label">Kode obat</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?= $dataDipilih["kode_obat"] ?>" id="kode_obat" name="kode_obat">
								</div>
							</div>
							<div class="form-group row">
								<label for="nama_obat" class="col-sm-2 col-form-label">Nama obat</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?= $dataDipilih["nama_obat"] ?>" id="nama_obat" name="nama_obat">
								</div>
							</div>
							<div class="form-group row">
								<label for="jumlah_masuk" class="col-sm-2 col-form-label">Jumlah Masuk</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?= $dataDipilih["jumlah_masuk"] ?>" id="jumlah_masuk" name="jumlah_masuk">
								</div>
							</div>

							<div class="form-group row">
								<label for="harga_perobat" class="col-sm-2 col-form-label">Harga Perobat</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?= $dataDipilih["harga_perobat"] ?>" id="harga_perobat" name="harga_perobat">
								</div>
							</div>
							<div class="form-group row">
								<label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
								<div class="col-sm-10">
									<input type="date" class="form-control" value="<?= $dataDipilih["tanggal_masuk"] ?>" id="tgl_masuk" name="tgl_masuk" value="<?= date('Y-m-d') ?>">
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" name="tambah" class="btn btn-warning" value="Ubah">
							</div>
					</div>
					</form>



				</div>
			</div>
		</div>


</div>

</div>
</div>
</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#id_obat").chosen();
	})
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#id_obat').change(function() {
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('resep_obat/cek_obat') ?>',
				Cache: false,
				dataType: "json",
				data: 'id_obat=' + id,
				success: function(resp) {
					$('#id_obat').val(resp.id_obat);
					$('#stok').val(resp.stok);
					$('#harga').val(resp.harga);
				}
			});
			// alert(id);
		});



	});
</script>