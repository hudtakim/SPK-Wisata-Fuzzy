<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

?>

<?php

 ?>

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistem Pendukung Keputusan</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style type="text/css">
	#home{
		text-align: center;
		background-image: url("https://image.myanimelist.net/ui/qZ_8jcwPFtYxKx-4xT6ZrruSqz37nZYqAJuKv91B00EgtWa1Fzpw7uOcMvoZIF_VmrOIW8XkYQxBKl2LiQPUJwZw6dYl9M9xbZ2ftNMwZOM64OZhvbPY2gB4elov7hWZz5C44KqcjG8XUNwbN4B4fA"); 
		background-size: cover;
	}
	p{
		font-size: 20px;
	}
	
	input[type="reset"]{
	margin-bottom: 28px;
	width: 120px;
	height: 32px;
	background: #F44336;
	border: none;
	border-radius: 2px;
	color: #fff;
	font-family: sans-serif;
	text-transform: uppercase;
	transition: 0.2s ease;
	cursor: pointer;
	}
	input[type="submit"]{
	margin-bottom: 28px;
	width: 120px;
	height: 32px;
	background: #39f436;
	border: none;
	border-radius: 2px;
	color: #fff;
	font-family: sans-serif;
	text-transform: uppercase;
	transition: 0.2s ease;
	cursor: pointer;
	}
	font2{
		font-size: 17px;
		padding-left: 50px;
	}

	body{
		background: orange;
	}
	h1{
		text-shadow: 5px 2px blue;
	}
	a { color: inherit; }
	a:hover { color: inherit; } 

</style>

<body>
	<div class='container mt-5'>
		<div class="jumbotron" id='home'>
			<h1 class="text-light shadow-lg"><a href="/wisataweb">Sistem Pendukung Keputusan</a></h1>
			<p class="h3 text-light shadow-lg" style="text-shadow: 2px 2px red;">Pemilihan Objek Pariwisata Tegal</p>
		</div>
		<p align="center"><b>Ini adalah laman khusus admin</b></p>
        <a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block mt-4 mb-4">Logout</button></a>
		<message>
			1. Silahkan tambah kriteria, pastikan nama kriteria dan sub-kriteria sesuai dengan kolom tabel pada database<br>
			2. Pastikan kriteria baru yang akan dimasukkan sudah terdapat pada database<br>
        </message>
		<div class="edit-kriteria mt-4">
			<form name="tambah-kriteria" action="process.php" method="POST">
				<input type="text" placeholder= "Kriteria" name="kriteria" value="">
				<input type="text" placeholder= "Nilai Bawah" name="bawah" value="">
				<input type="text" placeholder= "Nilai Tengah" name="tengah" value="">
				<input type="text" placeholder= "Nilai Atas" name="atas" value="">
				<button type="submit" class="btn btn-success" name="submit">Tambah Kriteria</button>
			</form>
		</div>

		<div class="daftar-kriteria mt-5">
			<table class='table table-bordered'>
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Kriteria</th>
						<th>Nilai Bawah</th>
						<th>Nilai Tengah</th>
						<th>Nilai Atas</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				<?php
					$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
					$num = 1;
					while($data = mysqli_fetch_array($daftar_kriteria)):
				?>
				<tr>
					<th><?=$num;?></th>
					<th><?=$data['kriteria'];?></th>
					<th><?=$data['bawah'];?></th>
					<th><?=$data['tengah'];?></th>
					<th><?=$data['atas'];?></th>
					<th><a href="delete.php?id=<?php echo $data['id']; ?>"><button class="btn btn-danger">Delete</button></a></th>
				</tr>
				<?php $num++; endwhile;?>
				</tbody>
			</table>
		</div>

	</div>
</body>
</html>