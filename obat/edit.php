<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Obat</h1>
	<h4>
		<small>Edit Data Obat</small>
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
					<label for="nama">Nama Obat</label>
					<input type="hidden" name="id" value="<?= $data['id_obat'] ?>">
					<input type="text" name="nama" value="<?= $data['nama_obat'] ?>" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="ket">Keterangan</label>
					<textarea name="ket" id="ket" class="form-control" required=""><?= $data['ket_obat'] ?></textarea>
				</div>
				<div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" class="form-control" value="<?=$data['ket_obat']?>" required><?=$data['ket_obat']?></textarea>
                </div>
                <div class="form-group">
                    <label for="supl">Suplier</label>
                    <select name="supl" id="supl" class="form-control">
                        <?php
                            $sql="select * from tb_supplier";
                            $hasil=mysqli_query($con,$sql);
                                
                            while ($input = mysqli_fetch_array($hasil)) {
                                if ($data['supplier']== $input['nama_perusahaan']) {
                                        $select = "Selected";
                                }else{
                                    $select = "";
                                }
                                echo "<option $select>$input[nama_perusahaan]</option>";
                                }
                            ?>
				    </select>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control">
                        <?php
                            $sql="select * from tb_satuan";
                            $hasil=mysqli_query($con,$sql);
                                
                            while ($input = mysqli_fetch_array($hasil)) {
                                if ($data['satuan']== $input['satuan']) {
                                        $select = "Selected";
                                }else{
                                    $select = "";
                                }
                                echo "<option $select>$input[satuan]</option>";
                                }
                        ?>
				    </select>
                </div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
