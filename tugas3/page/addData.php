<?php
    require_once('../process/employee.php');

	
    $tambah = new Employee();
	$divisions = $tambah->tampilDevisi();
	$gaji = $tambah->tampilGaji();
    if(isset($_POST["submit"])){
        $tambah->tambahData($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    <title>Tambah Data Karyawan</title>
</head>
<body>
	<div class="container">
	<h2>Tambah data Karyawan</h2>
		<form method="POST" action="" >
			<table>
				<tr>
					<td>Nama </td>
					<td>:</td>
					<td><input type="text" name="name" required/></td>
				</tr>
				<tr>
					<td>Umur</td>
					<td>:</td>
					<td><input type="number" name="age" required/></td>
				</tr>
				<tr>
					<td>Devisi</td>
					<td>:</td>
					<td>
						
					
						<select name="division" id="division">
							<option value="">Pilih Devisi</option>
						<?php foreach( $divisions as $divisi ): ?>
							<option value="<?= $divisi["name"] ?>" ><?= $divisi["name"] ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kondisi Gaji</td>
					<td>:</td>
					<td>
						<?php foreach( $gaji as $g ): ?>
							<input type="radio" id="age1" name="gaji" value="<?= $g["name"]?>" required>
							<label for="age1"><?= $g["name"]?></label>
						<?php endforeach ?>

					</td>
				</tr>
				<tr>
					<td>Gaji</td>
					<td>:</td>
					<td><input type="number" name="salary" /></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><button type="submit" name="submit">simpan</button>
					<a href="../index.php">cancel</a></td>
					
				</tr>
			</table>
		</form>
	</div>
</body>
</html>