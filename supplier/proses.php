<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$ket = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	mysqli_query($con, "INSERT INTO tb_supplier VALUES('$nama', '$ket')") or die(mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id = $_POST['nama'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	mysqli_query($con, "UPDATE tb_supplier SET nama_perusahaan = '$nama', alamat = '$alamat' WHERE nama_perusahaan = '$id'") or die(mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}