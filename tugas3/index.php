<?php 
    require_once('process/employee.php');
    $database = new Employee();
    $karyawans = $database->tampilData();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP TUGAS2</title>
</head>
<body> 
    <div class="container">
    <h2>Data Karyawan</h2>
    <a href="page/addData.php"><button>Tambah Data Karyawan</button></a>
    <table border="1">
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Age</th>
        <th>Division</th>
        <th>Salary</th>
        <th>Action</th>
        </tr>
        <?php 
        $i = 1;
        foreach($karyawans as $karyawan): ?>
        <tr>
            <td><?=  $i; ?></td>
            <td><?=  $karyawan["name"]; ?></td>
            <td><?=  $karyawan["age"]; ?></td>
            <td><?=  $karyawan["division"]; ?></td>
            <td>Rp. <?php  
            $salary =  $karyawan["salary"]; 
            $tampil = number_format($salary,0,',','.'); 
            echo $tampil;
            ?></td>
            <td>
                <a href="page/updateData.php?id=<?= $karyawan["id"] ?>">Update</a>
                |
                <a href="process/delete.php?id=<?= $karyawan["id"]?>" onclick="return confirm('yakin data dihapus');">Delete</a>
            </td>
            <?php $i++; ?>
        </tr>
        <?php endforeach ?>
    </table>
    </div>
</body>
</html>