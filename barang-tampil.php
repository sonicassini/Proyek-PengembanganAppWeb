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
	width: 500px;
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
#tampil {
	width: 800px;
	border: 1px solid white;
	background: #ssoonn;
	padding: 5px;
	margin: 40px auto;
	box-shadow: 10px 10px 10px silver;
	border-radius: 10px;
	color:silver;
}
#tampil input{
	border-radius: 5px;
	height: 30px;
	font-weight: bold;
	font-style: italic;
	font-size:17px;
}
#tampil th{
	color:white;
	
}
#tampil td{
	font-size:25px;
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
<div id="tampil">		
	<link rel="stylesheet" type="text/css" href="style.css">
	<form align="right">
		Cari : <input type="text" name="cari">
		<input type="submit" value="Tampilkan">

	</form>
	<hr/>
	<?php
		include "koneksi.php";
		$sql = "select * from barang";
		if (isset($_GET['cari'])){
			$cari = $_GET['cari'];
			$sql .= " where nama_barang like '%$cari%' or harga like '%$cari%' or kode_barang like '%$cari%'";
		}
		$hasil = mysqli_query($konek, $sql);
		
		$jumData = mysqli_num_rows($hasil);
			echo "<h4 align=right>Terdapat : <b>$jumData</b> Barang</h4>";
		if (isset($_GET['cari'])){
			echo " <h4 align=right>[Kunci Pencarian : $cari]</h4>";
		}
	?>
	<h3 align="center">DAFTAR BARANG</h3>
	<input type="button" value="Tambah" onclick="window.location='barang-isi.php';">
	<table border="1" class="grid" align="center" width="800px" height="150px">
		<tr>
			<th>NO</th><th>GAMBAR</th><th>NAMA BARANG</th><th>HARGA (Unit)</th>
			<th>OPSI</th>
		</tr>
	<?php
		//kalo sampe sini berarti berhasil query
		$no = 0;
		while($data = mysqli_fetch_assoc($hasil)){
			$no++;
			if($no % 2 == 0)
				echo "<tr class='genap'>";
			else
				echo "<tr class='ganjil'>";

			echo "<td style='width:50px' align='center'> $no </td>";

			echo "<td style='width:100px'><img src = 'images/".$data['gambar']."' width='100px' height='100px'> </td>"
			."<td>".$data['nama_barang']."</td>"
			."<td align='right'>Rp. ".number_format($data['harga'])."</td>";

			echo "
				<td align='center'>

				<a href='barang-edit.php?kode_barang={$data['kode_barang']}'>Edit</a>

				<a href='barang-hapus.php?kode_barang={$data['kode_barang']}' 
				onClick='return confirm(\"Yakin Hapus {$data['nama_barang']}?\")'
				>Hapus</a>
				</td>
				";
			echo "</tr>";
		}
	?>
	</table>
</div>
<div id="footer">
	<p style="font:14px verdana">
		Hak Cipta &copy; <?php $today = date("Y"); echo "$today"; ?> By: Soni Cassini STMIK AKAKOM Yogyakarta
	</p>
	<p style="font:14px courier new">
		Phone/WA. +62 82240841498  <br/>
		Email : <a href="mailto:sonicassini@gmail.com">sonicassini@gmail.com</a>
	</p>
</div>
</body>