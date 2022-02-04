<?php
    require_once('../process/employee.php');

    $tambah = new Employee();

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
					<td><input type="text" name="division" required/></td>
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