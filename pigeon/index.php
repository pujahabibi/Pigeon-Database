<?php
	$msg = "";
	if(isset($_POST['upload'])){
		$target = "image/".basename($_FILES['gambar']['name']);
		
		$db = mysqli_connect("localhost", "root", "", "pigeon");
		
		$nomor_ring = $_POST['nomor_ring'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$riwayat = $_POST['riwayat'];
		$gambar = $_FILES['gambar']['name'];
		$prestasi = $_POST['prestasi'];
		
		$sql = "INSERT INTO data_pigeon (nomor_ring, tanggal_lahir, jenis_kelamin, riwayat, prestasi, gambar) 
		VALUES ('$nomor_ring', '$tanggal_lahir', '$jenis_kelamin', '$riwayat', '$prestasi', '$gambar')";
		mysqli_query($db, $sql);
		
		if(move_uploaded_file($_FILES['gambar']['tmp_name'], $target)){
			$msg = "Image uploaded successfully";
		}else{
			$msg = "There was a problem";
		}
	}
?>
<html>
<head>
	<title>Pigeon Database</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="content">
		<form method="post" action="index.php" enctype="multipart/form-data">
			Nomor Ring Pigeon: </br>
			<div>
				<input type="text" name="nomor_ring">
			</div>
			<br>
			<br>
			Tanggal Lahir Pigeon: </br>
			<div>
				<input type="text" name="tanggal_lahir">
			</div>
			<br>
			<br>
			Jenis Kelamin Pigeon: </br>
			<div>
				<input type="text" name="jenis_kelamin">
			</div>
			<br>
			<br>
			Riwayat Pigeon: </br>
			<div>
				<input type="text" name="riwayat">
			</div>
			<br>
			<br>
			Gambar Pigeon: </br>
			<input type="hidden" name="size" value="1000000">
			<div>
				<input type="file" name="gambar">
			</div>
			<br>
			<br>
			Prestasi Pigeon: <br>
			<div>
				<textarea name="prestasi" cols="40" rows="4" 
				placeholder="Say something about this image....">
				</textarea>
			</div>
			<div>
				<input type="submit" name="upload" value="Upload Image">
			</div>
		</form>
		<hr>
		<br>
		<h1>Data Record</h1>
		<br>
		<?php
		$db = mysqli_connect("localhost", "root", "", "pigeon");
		$sql = "SELECT * FROM data_pigeon";
		$result = mysqli_query($db, $sql);
		while($row = mysqli_fetch_array($result)){
			echo "<div id='img_div'>";
			echo "<img src='image/".$row['gambar']."'>";
			echo "<p>Nomor Ring: ".$row['nomor_ring']."</p>";
			echo "<p>Jenis Kelamin: ".$row['jenis_kelamin']."</p>";
			echo "<p>Tanggal Lahir: ".$row['tanggal_lahir']."</p>";
			echo "<p>Riwayat: ".$row['riwayat']."</p>";
			echo "<p>Prestasi: ".$row['prestasi']."</p>";
			echo "</div>";
		}
		?>
	</div>
</body>
</html>