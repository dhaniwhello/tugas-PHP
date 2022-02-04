<?php
    require_once('../process/employee.php');
	//ambil data dari url
	$id= $_GET["id"];
	// menginisiasi class Employee
	$database = new Employee();
	//memanggil fungsi menampilkan data per id
	$karyawan = $database->dataId($id)[0];

    if(isset($_POST["submit"])){
        $database->updateData($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    <title>Update Data Karyawan</title>
</head>
<body>
	<div class="container">
		<h2>Update Data</h2>
	<form method="POST" action="" >
	
		<input type="hidden" name="id" value="<?=$karyawan["id"]?>;">
			<table>
			<tr>
				<td>Nama </td>
				<td>:</td>
				<td><input type="text" name="name" value="<?= $karyawan['name']; ?>"/></td>
			</tr>
			<tr>
				<td>Umur</td>
				<td>:</td>
				<td><input type="number" name="age" value="<?= $karyawan["age"]; ?>" /></td>
			</tr>
			<tr>
				<td>Devisi</td>
				<td>:</td>
				<td><input type="text" name="division" value="<?= $karyawan["division"]; ?>"/></td>
			</tr>
			<tr>
				<td>Gaji</td>
				<td>:</td>
				<td><input type="number" name="salary" value="<?= $karyawan["salary"]; ?>"/></td>
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