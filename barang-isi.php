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
<div id="content">
	<h3 align=center>TAMBAH BARANG</h3><hr/>
	<form action="barang-simpan.php" method="post" enctype="multipart/form-data">
	<p style="font:20px verdana">
	<table>
		<tr>
			<td>Kode Barang</td>
			<td> : <input type="text" name="kode_barang" maxLength="5" size="5" placeholder="max 5"></td>
		</tr>
		<tr>
			<td>Nama Barang</td>
			<td> : <input type="text" name="nama_barang"></td>
		</tr>
		<tr>
			<td>Unit</td>
			<td> : <input type="text" name="stok" size="7"></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td> : <input type="text" name="harga" placeholder="Harga Per Unit" size="10"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td> : <input type="text" name="tanggal" value="<?php $today = date("Y-m-d"); echo "$today";?>" size="7" readonly> Today</td>
		</tr>
		<tr>
			<td>Gambar</td>
			<td> : <input type="file" name="gambar"></td>
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