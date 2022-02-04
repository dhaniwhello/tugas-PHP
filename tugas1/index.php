<?php require_once('data.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP TUGAS1</title>
</head>
<body>
    <div class="container">
    <h2>Data dari class Employee</h2>
    <p>Nama: <?php echo $employee->name; ?></p>
    <p>Age: <?php echo $employee->age; ?></p>
    <p>Division: <?php echo $employee->division; ?></p>
    <p>Salary: <?php echo $employee->salary; ?></p>
    </div>
</body>
</html>