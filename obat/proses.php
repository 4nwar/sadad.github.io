<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

if(isset($_POST['add'])){
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$ket = trim(mysqli_real_escape_string($con, $_POST['ket']));
	$supl = $_POST['supl'];
    $jml = $_POST['jml'];
    $satuan = $_POST['satuan'];
    mysqli_query($con, "INSERT INTO tb_obat (nama_obat,ket_obat,supplier,jumlah,satuan) VALUES ('$nama', '$ket', '$supl', '$jml', '$satuan')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$ket = trim(mysqli_real_escape_string($con, $_POST['ket']));
	$supl = $_POST['supl'];
    // $jml = $_POST['jml'];
    $satuan = $_POST['satuan'];
    mysqli_query($con, "UPDATE tb_obat SET nama_obat = '$nama', ket_obat= '$ket', supplier='$supl',satuan='$satuan' WHERE id_obat= '$id'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
if(isset($_POST['stok'])){
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama_stok']));
    $jml = $_POST['jml_stok'];
    mysqli_query($con, "INSERT INTO tb_update_obat (tanggal,nama,jumlah) VALUES (NOW(),'$nama', '$jml')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}