<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Obat</h1>
	<h4>
		<small>Tambah Data Obat</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Obat</label>
                        <input type="text" name="nama" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea name="ket" id="ket" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="supl">Suplier</label>
                        <select name="supl" id="supl" class="form-control">
                            <?php
                                $sql="select * from tb_supplier";
                                $hasil=mysqli_query($con,$sql);
                                $no=0;
                                while ($data = mysqli_fetch_array($hasil)) {
                                $no++;
                                ?>
                                <option value="<?php echo $data['nama_perusahaan'];?>"><?php echo $data['nama_perusahaan'];?></option>
                                <?php 
                                }
                            ?>
				        </select>
                    </div>
                    <div class="form-group">
                        <label for="jml">Jumlah</label>
                        <input type="text" name="jml" id="jml" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select name="satuan" id="satuan" class="form-control">
                            <?php
                                $sql="select * from tb_satuan";
                                $hasil=mysqli_query($con,$sql);
                                $no=0;
                                while ($data = mysqli_fetch_array($hasil)) {
                                $no++;
                                ?>
                                <option value="<?php echo $data['satuan'];?>"><?php echo $data['satuan'];?></option>
                                <?php 
                                }
                            ?>
				        </select>
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" name="add" value="Simpan" class="btn btn-success">
                    </div>
                </form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
