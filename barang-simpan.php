<?php
include "koneksi.php";
	$kode_barang 	= $_POST['kode_barang'];
	$nama_barang 	= $_POST['nama_barang'];
	$stok			= $_POST['stok'];
	$harga			= $_POST['harga'];
	$tanggal 		= $_POST['tanggal'];

	$submit 		= $_POST['submit'];

	//ini untuk gambar
	$name 		= $_FILES['gambar']['name'];
	$tmp_name 	= $_FILES['gambar']['tmp_name'];
	$type 		= $_FILES['gambar']['type'];
	$size 		= $_FILES['gambar']['size'];

	//disini ditambahi untuk gambar lama
	if (submit == "Update"){
		$gambar_lama = $_POST['gambar_lama'];
	}

	//Disini validasi
	$dataOke = "YA";
	$pesan = "";
	if (strlen(trim($kode_barang)) == 0){
		$pesan .= "Kode Barang Harus Diisi \\n";
		$dataOke = "TIDAK";
	}

	if (strlen(trim($nama_barang)) == 0){
		$pesan .= "Nama Barang Harus Diisi \\n";
		$dataOke = "TIDAK";
	}

	if (strlen(trim($stok)) == 0){
		$pesan .= "Unit Harus Diisi \\n";
		$dataOke = "TIDAK";
	}

	if (strlen(trim($harga)) == 0){
		$pesan .= "Harga Harus Diisi \\n";
		$dataOke = "TIDAK";
	}

	if (strlen(trim($tanggal)) == 0){
		$pesan .= "Tanggal Harus Diisi \\n";
		$dataOke = "TIDAK";
	}

	//validasi utk gambar
	$allowed_image = array("image/png", "image/jpeg", "image/jpg");
	
	$max_size = 1000000; //100kb
	if($size > 0){

		if(!in_array($type, $allowed_image)){
			$pesan .= "Type File Upload Hanya Bisa PNG dan JPG \\n";
			$dataOke = "TIDAK";
			}

		if($size > $max_size){
			$pesan .= "Gambar Terlalu Besar, Maksimum".($max_size/1000)." KB \\n";
			$dataOke = "TIDAK";		
			}
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

	//penyimpanan
	include "koneksi.php";
	
	$saldo = $stok * $harga;

	if($submit == "Update"){
		//jika tdk upload gambar atau gambar lama = gambar baru
		//maka gambar simpan gunakan gambar lama
		if (($size == 0) or ($gambar_lama == $name)){
			$gambar_simpan = $gambar_lama;
		}else {
			$gambar_simpan = $name;
		}

		$sql1 = "update barang set 
					nama_barang = '$nama_barang',
					harga = '$harga',
					saldo = $saldo,
					gambar = '$gambar_simpan'

					where kode_barang = '$kode_barang'
					";
	} else {
		$sql1 = "insert into barang 
					(kode_barang, nama_barang, stok, harga, saldo, gambar)
					values
					('$kode_barang', '$nama_barang', '$stok', '$harga', '$saldo', '$name')
					";

		$sql2 = "insert into mutasi 
					(no_transaksi, kode_barang, keterangan, tanggal, unit)
					values
					('$kode_barang', '$kode_barang', 'Saldo Awal', '$tanggal', '$stok')
					";
			}

			$hasil = mysqli_query($konek, $sql1);
			if (!$hasil) {
				$err = mysqli_error($konek);
				echo 	"<script>
							alert(\"Gagal Simpan Data Barang : $err\");
							self.history.back();
						</script>";
				exit;
			}

			$hasil = mysqli_query($konek, $sql2);
			if (!$hasil) {
				$err = mysqli_error($konek);
				echo 	"<script>
							alert(\"Gagal Simpan Data Mutasi : $err\");
							self.history.back();
						</script>";
				
			}
			//kalau sampai sini berarti berhasil simpan ke tabel
			
			//jika ini update dan gambar lama beda dgn gambar baru
			//maka hapus dulu gambar lama
			if(($submit == "Update") and ($gambar_lama != $name)){
				unlink("images/".$gambar_lama);
			}

			//maka disini proses upload gambar
			if($size > 0)
			$tujuan = "images/".$name;
			$hasil = move_uploaded_file($tmp_name, $tujuan);
			if (!$hasil) {
				echo 	"<Script>
							alert('gagal Upload Gambar');
							self.history.back();
						</script>";
			}

			//jika semua lancar, maka jalankan barang_tampil
			header("location:barang-tampil.php");
?>