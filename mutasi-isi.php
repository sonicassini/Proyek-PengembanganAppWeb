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
	width: 400px;
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
	width: 700px;
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
<div id="content">
	<h3 align=center>MUTASI BARANG</h3><hr/>
	<form action="mutasi-simpan.php" method="POST" enctype="multipart/form-data">
	<p style="font:20px verdana">
	<table>
		<tr>
			<td>No Transaksi</td>
			<td> : <input type="text" name="no_transaksi" maxLength="5"size="5" placeholder="max 5" autofocus></td>
		</tr>
		<tr>
			<td>Barang</td>
			<td> : 
				<select name="kode_barang">
				<option value="">-Pilih Barang-</option>
				<?php
					include "koneksi.php";
					$res = mysqli_query($konek, "select * from barang");
					if (!$res) die("Gagal Query Barang");
					while($row = mysqli_fetch_assoc($res)){
						echo "<option value='{$row['kode_barang']}'> {$row['nama_barang']}</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
  			<td>Keterangan</td>
  			<td> : <input type="radio" name="keterangan" value="Masuk">Masuk
  		 	<input type="radio" name="keterangan" value="Keluar">Keluar
  			</td>
		</tr>  
		<tr>
			<td>Tanggal</td>
			<td> : <input type="text" name="tanggal" value="<?php $today = date("Y-m-d"); echo "$today";?>" size="7" readonly> Today</td>
		</tr>
		<tr>
			<td>Unit</td>
			<td> : 
				<input type="number" name="stok">
			</td>
		</tr>
		<tr>
			<td colspan='2' align='center'>
				<input type="submit" name="submit" value="Tambah">
			</td>
		</tr>
	</table>
	</form>
	</p>
</div>		
<div id="tampil">		
	<link rel="stylesheet" type="text/css" href="style.css">
	<h3 align="center">SALDO BARANG</h3>
	<hr/>
	<?php
		include "koneksi.php";

		$sql = "select * from barang";
		$hasil = mysqli_query($konek, $sql);
		if(!$hasil){
			die("Gagal Query Masuk Karena ".mysqli_error($konek));
		}
	?>

	<table border="1" class="grid" align="center" width="700px" height="150px">
		<tr>
			<th>BARANG</th><th>STOK</th><th>SALDO</th><th>DETAIL</th>
		</tr>
<?php
	$no = 0;
	while($data = mysqli_fetch_assoc($hasil)){
		$no++;
		if($no == 1)
			echo "<tr style='background:lightblue'>";
		else
			echo "<tr style='background:lightgreen'>";

			echo "<td align='center'>".$data['nama_barang']."</td>"
			."<td align='right'>".number_format($data['stok'])." Unit</td>"
			."<td align='right'>Rp. ".number_format($data['saldo'])."</td>";

		echo "
			<td style='width:150px' align='center'>
			<a href='detail-tampil.php?kode_barang={$data['kode_barang']}'>Lihat</a>
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