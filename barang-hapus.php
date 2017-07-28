<?php
	include "koneksi.php";
	$kode_barang = $_GET['kode_barang'];

	//ambil gambar
	$sql = "select gambar from barang where kode_barang = '$kode_barang'";
	$hasil = mysqli_query($konek, $sql);
	$dt = mysqli_fetch_assoc($hasil);
	$nama_gambar = $dt['gambar'];

	//hapus data barang
	$sql1 = "delete from barang where kode_barang = '$kode_barang'";
	$sql2 = "delete from mutasi where kode_barang = '$kode_barang'";
	$hasil = mysqli_query($konek, $sql1);
	$hasil = mysqli_query($konek, $sql2);
	if(!$hasil){
		echo "
			<script>
				alert('Gagal Hapus');
				self.history.back();
			</script>
		";
	} else{
		//jika berhasil hapus, maka hapus juga file gambar
		if (!empty(trim($nama_gambar))){
			$gbr = "images/".$nama_gambar;
			unlink($gbr);
		}
		header("location:barang-tampil.php");
	}
?>