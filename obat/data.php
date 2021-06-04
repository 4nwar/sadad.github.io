<?php include_once('../_header.php'); ?>

	<div class="box">
		<h1>Obat</h1>
		<h4>
			<small>Data Obat</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Obat</a>
			</div>
		</h4>
		<div style="margin-bottom:10px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="pencarian" class="form-control" placeholder="Pencarian...">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Obat</th>
                        <th>Keterangan</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>

				<tbody>
					<?php
						$batas = 5;
						$hal = @$_GET['hal'];
						if(empty($hal)){
							$posisi = 0;
							$hal = 1;
						}
						else{
							$posisi = ($hal - 1) * $batas;
						}
						$no = 1;
						if($_SERVER['REQUEST_METHOD'] == "POST"){
							$pencarian = trim(mysqli_real_escape_string($con, $_POST['pencarian']));
							if($pencarian != ''){
								$sql = "SELECT * FROM tb_obat WHERE nama_obat LIKE '%$pencarian%'";
								$query = $sql;
								$query_jml = $sql;
							}
							else{
								$query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
								$query_jml = "SELECT * FROM tb_obat";
								$no = $posisi + 1;
							}
						}
						else{
							$query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
							$query_jml = "SELECT * FROM tb_obat";
							$no = $posisi + 1;
						}
						
						$sql_obat = mysqli_query($con, $query) or die(mysqli_error($con));
						if(mysqli_num_rows($sql_obat) > 0){
							while($data = mysqli_fetch_array($sql_obat)){ ?>
								<tr>
									<td><?= $no++; ?>.</td>
									<td><?= $data['nama_obat']; ?></td>
									<td><?= $data['ket_obat']; ?></td>
									<td><?=$data['supplier']?></td>
                               		<td><?=$data['jumlah']?></td>
                               		<td><?=$data['satuan']?></td>
									<td class="text-center">
										<a href="edit.php?id=<?= $data['id_obat'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
										<a href="del.php?id=<?= $data['id_obat'] ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
										<a href="stok.php?id=<?= $data['id_obat'] ?>" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></i></a>
									</td>
								</tr>
							<?php
							}
						}
						else{
							echo "<tr><td colspan=\"7\" align=\"center\">Data tidak ditemukan</td></tr>";
						}
					?>
					<tr>
						
					</tr>
				</tbody>
			</table>
		</div>
		<?php
			if(isset($_POST['pencarian']) == ''){ ?>
				<div style="float: left;">
					<?php
						$jml = mysqli_num_rows(mysqli_query($con, $query_jml));
						echo "Jumlah data : <b>$jml</b>";
					?>
				</div>
				<div style="float: right;">
					<ul class="pagination pagination-sm" style="margin: 0">
						<?php
							$jml_hal = ceil($jml / $batas);
							for ($i=1; $i <= $jml_hal; $i++){ 
								if($i != $hal){
									echo "<li><a href=\"?hal=$i\">$i</a></li>";
								}
								else{
									echo "<li class=\"active\"><a href=\"?hal=$i\">$i</a></li>";
								}
							}
						?>
					</ul>
				</div>
			<?php
			}
			else{
				echo "<div style=\"float:left\">";
				$jml = mysqli_num_rows(mysqli_query($con, $query_jml));
				echo "Data hasil pencarian : <b>$jml</b>";
				echo "</div>";
			}
		?>
	</div>
	<div class="box">
		<h1>Riwayat tambah stok Obat</h1>
		<h4>
			<small>Data Riwayat Tambah Stok Obat</small>
		</h4>
		<div hidden style="margin-bottom:10px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="pencarian" class="form-control" placeholder="Pencarian...">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
                    <tr>
						<th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>

				<tbody>
					<?php
						$batas = 5;
						$hal = @$_GET['hal'];
						if(empty($hal)){
							$posisi = 0;
							$hal = 1;
						}
						else{
							$posisi = ($hal - 1) * $batas;
						}
						$no = 1;
						if($_SERVER['REQUEST_METHOD'] == "POST"){
							$pencarian = trim(mysqli_real_escape_string($con, $_POST['pencarian']));
							if($pencarian != ''){
								$sql_stok = "SELECT * FROM tb_update_obat WHERE nama LIKE '%$pencarian%'";
								$query_stok = $sql_stok;
								$query_jml_stok = $sql_stok;
							}
							else{
								$query_stok = "SELECT * FROM tb_update_obat LIMIT $posisi, $batas";
								$query_jml_stok = "SELECT * FROM tb_update_obat";
								$no_stok = $posisi + 1;
							}
						}
						else{
							$query_stok = "SELECT * FROM tb_update_obat LIMIT $posisi, $batas";
							$query_jml_stok = "SELECT * FROM tb_update_obat";
							$no_stok = $posisi + 1;
						}
						
						$sql_obat_stok = mysqli_query($con, $query_stok) or die(mysqli_error($con));
						if(mysqli_num_rows($sql_obat_stok) > 0){
							while($data_stok = mysqli_fetch_array($sql_obat_stok)){ ?>
								<tr>
									<td><?= $no++; ?>.</td>
									<td><?= $data_stok['tanggal']; ?></td>
									<td><?= $data_stok['nama']; ?></td>
									<td><?=$data_stok['jumlah']?></td>
								</tr>
							<?php
							}
						}
						else{
							echo "<tr><td colspan=\"4\" align=\"center\">Data tidak ditemukan</td></tr>";
						}
					?>
					<tr>
						
					</tr>
				</tbody>
			</table>
		</div>
		<?php
			if(isset($_POST['pencarian_stok']) == ''){ ?>
				<div style="float: left;">
					<?php
						$jml_stok = mysqli_num_rows(mysqli_query($con, $query_jml_stok));
						echo "Jumlah data : <b>$jml_stok</b>";
					?>
				</div>
				<div style="float: right;">
					<ul class="pagination pagination-sm" style="margin: 0">
						<?php
							$jml_hal = ceil($jml / $batas);
							for ($i=1; $i <= $jml_hal; $i++){ 
								if($i != $hal){
									echo "<li><a href=\"?hal=$i\">$i</a></li>";
								}
								else{
									echo "<li class=\"active\"><a href=\"?hal=$i\">$i</a></li>";
								}
							}
						?>
					</ul>
				</div>
			<?php
			}
			else{
				echo "<div style=\"float:left\">";
				$jml_stok = mysqli_num_rows(mysqli_query($con, $query_jml_stok));
				echo "Data hasil pencarian : <b>$jml_stok</b>";
				echo "</div>";
			}
		?>
	</div>


<?php include_once('../_footer.php'); ?>