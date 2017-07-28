<?php
	$no_transaksi = $_POST['no_transaksi'];
	$kode_barang = $_POST['kode_barang'];
	$keterangan = $_POST['keterangan'];
	$tanggal = $_POST['tanggal'];
	$stok = $_POST['stok'];
	$submit	= $_POST['submit'];

	//ambil stok bang
	include "koneksi.php";
	$sql = "select stok from barang";
		$hasil = mysqli_query($konek, $sql);
		$dt = mysqli_fetch_assoc($hasil);
		$stokkini = $dt['stok'];


	//Lakukan validasi disini
	$dataOke = "YA";
	$pesan = "";
	
	if (strlen(trim($no_transaksi)) == 0){
	$pesan .= "No Transaksi Harus Diisi \\n";
	$dataOke = "TIDAK";
	}

	if (strlen(trim($kode_barang)) == 0){
	$pesan .= "Kode Barang Harus Diisi \\n";
	$dataOke = "TIDAK";
	}

	if (strlen(trim($keterangan)) == 0){
	$pesan .= "Keterangan Harus Diisi \\n";
	$dataOke = "TIDAK";
	}

	if (strlen(trim($stok)) == 0){
	$pesan .= "Stok Harus Diisi \\n";
	$dataOke = "TIDAK";
	}


	//validasi stok

	if($keterangan == "Keluar"){
		$total = - $stok;
		
		if ($stok > $stokkini){
		$pesan .= "Stok Barang Tidak Mencukupi \\n";
		$dataOke = "TIDAK";
		}
	}else{
		$total = $stok;
	}

	//jika validasi gagal, beri pesan salah
	if($dataOke == "TIDAK"){
		$pesan = "Masih Ada Kesalahan \\n\\n".$pesan;
		echo "
			<script>
			alert('$pesan');
			self.history.back();
			</script>
		";
		exit; 
	}
	//Validasi selesai disini


	if($submit == "Update"){
		$sql1 = "update mutasi set 
					kode_barang 	= '$kode_barang',
					keterangan 		= '$keterangan',
					tanggal 		= '$tanggal',
					unit 			= '$stok'
					where no_transaksi = '$no_transaksi'
					";
	} else {
		$sql1 = "insert into mutasi 
					(no_transaksi, kode_barang, keterangan, tanggal, unit)
					values
					('$no_transaksi', '$kode_barang', '$keterangan', '$tanggal', '$stok')
					"; 

		$sql2 = "update barang set 
					stok 	= stok + '$total',
					saldo 	= saldo + (harga * '$total')
					where kode_barang = '$kode_barang'
					";
	}

	$hasil = mysqli_query($konek, $sql1);
	$hasil = mysqli_query($konek, $sql2);
	if (!$hasil){
		echo "Gagal Simpan :".mysqli_error($konek);
		echo "<br/> Tekan Tombol Back untuk kembali";
		exit;
	}else {
		// ini kalau berhasil simpan
		header("location:mutasi-isi.php");
	}
?>