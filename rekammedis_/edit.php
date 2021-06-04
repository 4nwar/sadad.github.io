<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Obat</h1>
	<h4>
		<small>Edit Data Supplier</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
				$sql_supplier = mysqli_query($con, "SELECT * FROM tb_supplier WHERE nama_perusahaan = '$_GET[id]'") or die(mysqli_error($con));
				$data = mysqli_fetch_assoc($sql_supplier);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama Perusahaan</label>
					<input type="text" name="nama" value="<?= $data['nama_perusahaan'] ?>" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea name="alamat" id="alamat" class="form-control" required=""><?= $data['alamat'] ?></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
