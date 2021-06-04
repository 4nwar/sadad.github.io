<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Obat</h1>
	<h4>
		<small>Tambah Stok Obat</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
				$id = @$_GET['id'];
				$sql_obat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$id'") or die(mysqli_error($con));
				$data = mysqli_fetch_array($sql_obat);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama_stok">Nama Obat</label>
					<input type="hidden" name="id" value="<?= $data['id_obat'] ?>">
					<input type="text" name="nama_stok" value="<?= $data['nama_obat'] ?>" class="form-control" required="">
				</div>
				<div class="form-group">
                        <label for="jml_stok">Jumlah</label>
                        <input type="text" name="jml_stok" id="jml_stok" class="form-control " autofocus="">
                </div>
				<div class="form-group">
					<input type="submit" name="stok" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
