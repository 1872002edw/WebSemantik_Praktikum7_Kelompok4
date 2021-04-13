<?php

include_once '../../entity/Mahasiswa.php';
include_once '../../dao/MahasiswaDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');
$mahasiswaDao = new MahasiswaDaoImpl();
$list_mahasiswa = $mahasiswaDao->getMahasiswaData();

echo json_encode($list_mahasiswa);