<head>
<style type="text/css">
#wrap {
	width:1000px;
	margin:auto;
	box-shadow:5px 5px 5px 5px grey;
	border-radius:10px;
	background-image:url(back2.jpg);
}
#menu_horizontal {
	width:1000px;
	height:30px;
	border:1px solid white;
	background-color: grey;
	color:white;
	text-align:center;
	position:fixed;
	top:0px;
	z-index:200px;
	box-shadow:5px 5px 5px gray;
	border-radius:10px
}
#menu_horizontal ul {
	padding:0px;
	margin:3px;
	list-style-type:none;
}
#menu_horizontal li {
	display:inline;
}
#menu_horizontal li a {
	text-decoration:none;
	color:white;
	border-right:1px solid white;
	padding: .2em 1em;
	font-size:16px;
}
#menu_horizontal li a:hover {
	background-color:blue;
	color:white;
}
#header {
	position:relative;
	top:27px;
	max-width:1000px;
	height:200px;
	background-image:url(background-green.jpg);
	display:block;
	box-shadow:5px 5px 5px gray;
	border-radius:10px;
	text-align : right;
	font-size: 20px;
	color : white;
}
#slogan {
	position:absolute;
	width:400px;
	height:170px;
	top:10px;
}
#slogan h1 {
	font-family:gabrielle;
	font-size:40px;
	text-align:right;
	font-weight:bold;
	color:red;
	margin-top:30px;
	margin-bottom:0px;
	padding:0;
	text-shadow:3px 2px 1px black;
}
#slogan h2 {
	font-family:gabrielle;
	font-size:20px;
	text-align:right;
	font-weight:bold;
	color:brown;
	margin-top:0px;
	margin-bottom:0px;
	padding:0;
	text-shadow:3px 2px 1px grey;
}
@font-face {
	font-family: gabrielles;
	scr:url(gabrielle.ttf);
}
#slogan .slogan {
	font-family:tahoma,verdana,arial;
	font-size:18px;
	text-align:right;
	color:navy;
	font-weight:bold;
	font-style:italic;
	text-decoration:overline;
}
#content {
	width:700px;
	border: 1px solid white;
	background: #ssoonn;
	padding: 5px;
	margin: 40px auto;
	box-shadow: 10px 10px 10px silver;
	border-radius: 10px;
	color:silver;
}
#content td{
	color:white;
}
#content input {
	border-radius: 5px;
	height: 30px;
	font-weight: bold;
	font-style: italic;
	font-size:17px;
}
#footer {
	clear:both;
	margin-top:50px;
	margin-width:1000px;
	height:80px;
	background-color:lightgrey;
	color:black;
	display:block;
	text-align:center;
	padding:2px;
	opacity: 0.4;
	filter: alpha(opacity=40);
}

</style>
</head>
<body>
<body background="body_back.gif"/>
<div id="wrap">
	<div id="menu_horizontal">
		<ul>
			<li><a href="barang-tampil.php">Daftar Barang</a></li>
			<li><a href="mutasi-isi.php">Mutasi Barang</a></li>
		</ul>
	</div>
	<div id="header">
		<?php date_default_timezone_set("Asia/Jakarta"); echo date("D, d F Y - H:i"). " WIB";?>
	<div id="slogan"">
		<h1>Pencatatan</h1>
		<h2>Persediaan Barang</h2>
			<div class="slogan">https://github.com/sonicassini</div>
	</div>
	</div>
	<div id="content">
	
<?php
	include "koneksi.php";
	$kode_barang = $_GET['kode_barang'];
	$sql = "select * from barang where kode_barang = '$kode_barang'";
	$hasil = mysqli_query($konek, $sql);
	if(!$hasil) die("Gagal Query Barang");
	//Jika berhasil, maka ambil tiap field dgn fetch
	$dt = mysqli_fetch_assoc($hasil);
	//Letakkan tiap field ke dalam variabel
	$nama_barang = $dt['nama_barang'];
	$harga 		= $dt['harga'];
	$stok 		= $dt['stok'];
	$saldo 		= $dt['saldo'];
	$gambar 	= $dt['gambar'];

	$sql = "select * from mutasi where no_transaksi = '$kode_barang'";
	$hasil = mysqli_query($konek, $sql);
	if(!$hasil) die("Gagal Query Mutasi");
	//Jika berhasil, maka ambil tiap field dgn fetch
	$dt = mysqli_fetch_assoc($hasil);
	//Letakkan tiap field ke dalam variabel
	$tanggal = $dt['tanggal'];
?>	
<h3 align=center>EDIT BARANG</h3><hr/>
	
<form action="barang-simpan.php" method="post" enctype="multipart/form-data">
<p style="font:20px verdana">
<table width="700px">
<tr>
	<td align="left">Tanggal Terdaftar</td>
	<td align="center">Stok sekarang</td>
	<td align="right">Saldo Saat Ini</td>
</tr>
<tr>
	<td align="left"><input type="text" name="tanggal" size="12" value="<?php echo $tanggal;?>" readonly></td>
	<td align="center"><input type="text" name="stok" size="7" value="<?php echo number_format($stok). " Unit";?>" readonly></td>
	<td align="right"><input type="text" name="harga" size="10" value="<?php echo "Rp. " .number_format($saldo);?>" disabled></td>
</tr>
</table>
<br/>
<br/>
<table>
<tr>
	<td>Kode Barang</td>
	<td colspan="2"> : <input type="text" name="kode_barang" maxLength="5" size="5" readonly value="<?php echo $kode_barang;?>">
	</td>
</tr>
<tr>
	<td>Nama Barang</td>
	<td colspan="2"> : <input type="text" name="nama_barang" value="<?php echo $nama_barang;?>"></td>
</tr>
<tr>
	<td>Harga (Rp)</td>
	<td colspan="2"> : <input type="text" name="harga" size="10" value="<?php echo number_format($harga);?>"></td>
</tr>
<tr>
	<td >Gambar</td>
	<td> : <input type="file" name="gambar">
			<!-- bagian menulis nama gambar seblm diedit -->
			<input type="hidden" name="gambar_lama"
			value ="<?php echo $gambar;?>" >
	</td>
	<td>
			<!-- bagian nampil gambar seblm diedit -->
			<img src="images/<?php echo $gambar;?>"
			width="150px" height="150px">
	</td>
</tr>
<tr>
	<td colspan='3' align='center'>
		<input type="submit" name="submit" value="Update">
		<input type="button" value="Batal" onClick="self.history.back()">
	</td>
</tr>
</table>
</p>
</form>
		</div>

	<div id="footer">
		<p style="font:14px verdana">
			Hak Cipta &copy; <?php $today = date("Y");
		echo "$today"; ?> By: Soni Cassini STMIK AKAKOM Yogyakarta
		</p>
		<p style="font:14px courier new">
			Phone/WA. +62 82240841498  <br/>
			Email : <a href="mailto:sonicassini@gmail.com">sonicassini@gmail.com</a>
		</p>
	</div>
</body>