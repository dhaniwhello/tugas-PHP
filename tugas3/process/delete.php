<?php

require_once 'employee.php';
$konek = new Employee();
$id = $_GET["id"];
echo $id;
$konek->hapusData($id);

?>