<?php 
include"functions.php";
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
		<p align="center"><b>Silahkan Masukkan Kriteria Objek Wisata</b></p>

		<form method='GET' action="">
			<div class="form-row align-items-center">
			<?php
					$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
					$num = 1;
					while($data = mysqli_fetch_array($daftar_kriteria)):
				?>
				<div class="col-auto my-1">
					<label class="mr-sm-2" for="inlineFormCustomSelect"><?=$data['kriteria'];?></label>
					<select name='<?=strtolower($data['kriteria']);?>' class="custom-select mr-sm-1" id="inlineFormCustomSelect" required>
						<option value="">Choose...</option>
						<option value="<?=strtolower($data['bawah']);?>"><?=$data['bawah'];?></option>
						<option value="<?=strtolower($data['tengah']);?>"><?=$data['tengah'];?></option>
						<option value="<?=strtolower($data['atas']);?>"><?=$data['atas'];?></option>
					</select>
				</div>
			<?php $num++; endwhile;?>
			</div>
			<button type="submit" name='submit' class="btn btn-primary btn-lg btn-block mt-4 mb-4" value='and'>Submit - Logika AND</button>
			<button type="submit" name='submit' class="btn btn-success btn-lg btn-block mt-4 mb-4" value='or'>Submit - Logika OR</button>
		</form>

		<?php
			if(isset($_GET['submit'])){
				$submit = $_GET['submit'];
				if(isset($_GET['jenis'])){
					$jenis = $_GET['jenis'];
				} else {
					$jenis = "null";
				}
				if(isset($_GET['harga'])){
					$harga = $_GET['harga'];
				} else {
					$harga = "null";
				}
				if(isset($_GET['jarak'])){
					$jarak = $_GET['jarak'];
				} else {
					$jarak = "null";
				}
				if(isset($_GET['fasilitas'])){
					$fasilitas = $_GET['fasilitas'];
				} else {
					$fasilitas = "null";
				}
				if(isset($_GET['pengunjung'])){
					$pengunjung = $_GET['pengunjung'];
				} else {
					$pengunjung = "null";
				}
				
				echo "<br>Pilihan anda:";
				echo " -> Jenis: "; echo $jenis;
				echo " -> Harga: "; echo $harga;
				echo " -> Jarak: "; echo $jarak;
				echo " -> Fasilitas: "; echo $fasilitas;
				echo " -> Pengunjung: "; echo $pengunjung; echo "<br>";
		?>
		
		<h4>Berikut adalah saran objek wisata berdasarkan kriteria yang anda inputkan:</h4>
		<table class='table table-bordered'>
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama Wisata</th>
					<th>Jenis Wisata</th>
					<th>Harga Tiket (Rp)</th>
					<th>Jarak Wisata (KM)</th>
					<th>Jumlah Fasilitas</th>
					<th>Banyak Pengunjung</th>
					<th>Fire Strength</th>
				</tr>
			</thead>
			<tbody>

				<?php 
					if($jenis == 'alam'){
						$bobot_jenis = mysqli_query($conn,"SELECT alam from fuzzy_jenis");
					}else if($jenis == 'sosial_budaya'){
						$bobot_jenis = mysqli_query($conn,"SELECT sosial_budaya from fuzzy_jenis");
					}else if($jenis == 'religi_sejarah'){
						$bobot_jenis = mysqli_query($conn,"SELECT religi_sejarah from fuzzy_jenis");
					}else{
						$bobot_jenis = "null";
					}
	
					if($harga == 'murah'){
						$bobot_harga = mysqli_query($conn,"SELECT murah from fuzzy_harga");
					}else if($harga == 'sedang'){
						$bobot_harga = mysqli_query($conn,"SELECT sedang from fuzzy_harga");
					}else if($harga == 'mahal'){
						$bobot_harga = mysqli_query($conn,"SELECT mahal from fuzzy_harga");
					}else{
						$bobot_harga = "null";
					}
	
					if($jarak == 'dekat'){
						$bobot_jarak = mysqli_query($conn,"SELECT dekat from fuzzy_jarak");
					}else if($jarak == 'sedang'){
						$bobot_jarak = mysqli_query($conn,"SELECT sedang from fuzzy_jarak");
					}else if($jarak == 'jauh'){
						$bobot_jarak = mysqli_query($conn,"SELECT jauh from fuzzy_jarak");
					}else{
						$bobot_jarak = "null";
					}
	
					if($fasilitas == 'sedikit'){
						$bobot_fasilitas = mysqli_query($conn,"SELECT sedikit from fuzzy_fasilitas");
					}else if($fasilitas == 'cukup'){
						$bobot_fasilitas = mysqli_query($conn,"SELECT cukup from fuzzy_fasilitas");
					}else if($fasilitas == 'banyak'){
						$bobot_fasilitas = mysqli_query($conn,"SELECT banyak from fuzzy_fasilitas");
					}else{
						$bobot_fasilitas = "null";
					}
	
					if($pengunjung == 'sepi'){
						$bobot_pengunjung = mysqli_query($conn,"SELECT sepi from fuzzy_pengunjung");
					}else if($pengunjung == 'biasa'){
						$bobot_pengunjung = mysqli_query($conn,"SELECT biasa from fuzzy_pengunjung");
					}else if($pengunjung == 'ramai'){
						$bobot_pengunjung = mysqli_query($conn,"SELECT ramai from fuzzy_pengunjung");
					}else{
						$bobot_pengunjung = "null";
					}

					$fuzzy_jenis = array();
					$fuzzy_harga = array();
					$fuzzy_jarak = array();
					$fuzzy_fasilitas = array();
					$fuzzy_pengunjung = array();
					
					if($bobot_jenis != "null") {
						$bobot_jenis = mysqli_fetch_all($bobot_jenis);
						foreach ($bobot_jenis as &$value){
							array_push($fuzzy_jenis, $value[0]);
						}
					}else {for ($x = 0; $x < 15; $x++) {
						array_push($fuzzy_jenis, 1);
					  }
					}
					if($bobot_harga != "null") {
						$bobot_harga = mysqli_fetch_all($bobot_harga);
						foreach ($bobot_harga as &$value){
							array_push($fuzzy_harga, $value[0]);
						}
					}else {for ($x = 0; $x < 15; $x++) {
						array_push($fuzzy_harga, 1);
					  }
					}
					if($bobot_jarak != "null") {
						$bobot_jarak = mysqli_fetch_all($bobot_jarak);
						foreach ($bobot_jarak as &$value){
							array_push($fuzzy_jarak, $value[0]);
						}
					}else {for ($x = 0; $x < 15; $x++) {
						array_push($fuzzy_jarak, 1);
					  }
					}
					if($bobot_fasilitas != "null") {
						$bobot_fasilitas = mysqli_fetch_all($bobot_fasilitas);
						foreach ($bobot_fasilitas as &$value){
							array_push($fuzzy_fasilitas, $value[0]);
						}
					}else {for ($x = 0; $x < 15; $x++) {
						array_push($fuzzy_fasilitas, 1);
					  }
					}
					if($bobot_pengunjung != "null") {
						$bobot_pengunjung = mysqli_fetch_all($bobot_pengunjung);
						foreach ($bobot_pengunjung as &$value){
							array_push($fuzzy_pengunjung, $value[0]);
						}
					}else {for ($x = 0; $x < 15; $x++) {
						array_push($fuzzy_pengunjung, 1);
					  }
					}
						
					$fire_strength = array();
					$it = 0;
					foreach ($fuzzy_jenis as &$value) {
						if($submit == 'and'){
							array_push($fire_strength, $value * $fuzzy_harga[$it] * $fuzzy_jarak[$it] * $fuzzy_fasilitas[$it] * $fuzzy_pengunjung[$it]);
						}else{
							array_push($fire_strength, $value + $fuzzy_harga[$it] + $fuzzy_jarak[$it] + $fuzzy_fasilitas[$it] + $fuzzy_pengunjung[$it]);
						}
						$it = $it + 1;
					}
					
					if(array_sum($fire_strength) == 0){
						echo "<br><h1>TIDAK ADA REKOMENDASI</h1>";
					}else{
				
					$temp = array();
					$idx = 1;
					foreach ($fire_strength as &$value) {
						if($value > 0){
							$index_wisata = $idx;
							$get_wisata_query = mysqli_query($conn,"SELECT * from tempat_wisata_tb WHERE (id = '$index_wisata') ");
							while($data = mysqli_fetch_array($get_wisata_query)):
								$ob_wis = $data['obyek_wisata'];
								$jns = $data['jenis'];
								$hrg = $data['harga'];
								$jrk = $data['jarak'];
								$fsls = $data['fasilitas'];
								$pgnj = $data['pengunjung'];
								$it = $idx-1;
								$fs  = $fire_strength[$it];
								$b_jns = $fuzzy_jenis[$it];
								$b_hrg = $fuzzy_harga[$it];
								$b_jrk = $fuzzy_jarak[$it];
								$b_fsls = $fuzzy_fasilitas[$it];
								$b_pgnj = $fuzzy_pengunjung[$it];
	
								mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, jenis, harga, jarak, fasilitas, pengunjung, fire_strength) 
													VALUES('$ob_wis', '$jns','$hrg', '$jrk', '$fsls', '$pgnj', '$fs')");
								mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, bobot_jenis, bobot_harga, bobot_jarak, bobot_fasilitas, bobot_pengunjung, fire_strength) 
													VALUES('$ob_wis', '$b_jns','$b_hrg', '$b_jrk', '$b_fsls', '$b_pgnj', '$fs')");
	
							endwhile;
						} $idx++;
					}
					$get_rekomendasi_query = mysqli_query($conn,"SELECT * from rekomendasi_tb ORDER BY fire_strength DESC");
					$num = 1;
					while($data = mysqli_fetch_array($get_rekomendasi_query)):
					?>
						<tr>
							<th><?=$num;?></th>
							<th><?=$data['obyek_wisata'];?></th>
							<th><?=$data['jenis'];?></th>
							<th><?=$data['harga'];?></th>
							<th><?=$data['jarak'];?></th>
							<th><?=$data['fasilitas'];?></th>
							<th><?=$data['pengunjung'];?></th>
							<th><?=$data['fire_strength'];?></th>
						</tr>
	
				<?php $num++; endwhile; 
				mysqli_query($conn, "DELETE FROM rekomendasi_tb"); }
				?>

			</tbody>
		</table>

		<div class="mt-5 mb-5">
			<button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				Klik di sini untuk melihat hasil penghitungan fuzzy
			</button>

			<div class="collapse" id="collapseExample">
				<table class='table table-bordered mt-4'>
					<thead class="thead-dark">
						<tr>
							<th>No</th>
							<th>Nama Wisata</th>
							<th>Bobot Jenis</th>
							<th>Bobot Harga</th>
							<th>Bobot Jarak</th>
							<th>Bobot Fasilitas</th>
							<th>Bobot Pengunjung</th>
							<th>Fire Strength</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$get_fuzzy_query = mysqli_query($conn,"SELECT * from penghitungan_bobot_tb ORDER BY fire_strength DESC");
						$num = 1;
						while($data = mysqli_fetch_array($get_fuzzy_query)):
					?>
						<tr>
							<th><?=$num;?></th>
							<th><?=$data['obyek_wisata'];?></th>
							<th><?=$data['bobot_jenis'];?></th>
							<th><?=$data['bobot_harga'];?></th>
							<th><?=$data['bobot_jarak'];?></th>
							<th><?=$data['bobot_fasilitas'];?></th>
							<th><?=$data['bobot_pengunjung'];?></th>
							<th><?=$data['fire_strength'];?></th>
						</tr>

					<?php $num++; endwhile; mysqli_query($conn, "DELETE FROM penghitungan_bobot_tb"); }?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>