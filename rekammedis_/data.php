<!-- include _header.php -->
<?php 
include_once('../_header.php');
$user = $_SESSION['user'];
$id = $_SESSION['id_user']; 
?>
    <!-- tampilan data -->
    <div class="box">
		<h1>Rekam Medis</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<?php echo $user;?>
        <h4>
            <small>Rekam Medis</small>
        </h4>
        <div class="table-responsive">
            <table class="table table -striped table-bordered table-hover">
                <thead>
					<tr>
						<th>No.</th>
						<th>Tanggal Periksa</th>
						<th>Poli</th>
						<th>Nama Pasien</th>
						<th>Keluhan</th>
						<th>Nama Dokter</th>
						<th>Diagnosa</th>
						<th>Obat</th>
					</tr>
                </thead>
                <tbody>
                <?php
					$no = 1;
                    $sql_rekam = mysqli_query($con, "SELECT * FROM tb_rekammedis
					INNER JOIN tb_poliklinik ON tb_rekammedis.id_poli = tb_poliklinik.id_poli
					INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
					INNER JOIN tb_dokter ON tb_rekammedis.id_dokter = tb_dokter.id_dokter WHERE tb_rekammedis.id_pasien = '$id'") or die (mysqli_eror($conn,)); 
                    if (mysqli_num_rows($sql_rekam) > 0){
                       while ($data = mysqli_fetch_array($sql_rekam)) {?>
                           <tr>
						   <td><?= $no++; ?></td>
								<td><?= tgl_indo($data['tgl_periksa']); ?></td>
								<td><?= $data['nama_poli'] ?></td>
								<td><?= $data['nama_pasien'] ?></td>
								<td><?= $data['keluhan'] ?></td>
								<td><?= $data['nama_dokter'] ?></td>
								<td><?= $data['diagnosa'] ?></td>
								<td>
									<?php
									$sql_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat JOIN tb_obat ON tb_rm_obat.id_obat = tb_obat.id_obat WHERE id_rm = '$data[id_rm]'") or die(mysqli_error($con));
									while($data_obat = mysqli_fetch_array($sql_obat)){
										echo $data_obat['nama_obat']. "<br>";
									}
									?>
								</td>
                           </tr>
                        <?php
                       }
                    } else {
                       echo "<tr><td colspan=\"8\" align=\"center\">data tidak ditemukan</td></tr>";
                   }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- include _footer.php -->
<?php include_once('../_footer.php');?>