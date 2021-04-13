<?php

include_once '../../entity/Mahasiswa.php';
include_once '../../dao/MahasiswaDaoImpl.php';
include_once '../../util/PDOUtil.php';


$nrp = filter_input(INPUT_POST, "nrp");
$nama = filter_input(INPUT_POST, "nama");
$prodi = filter_input(INPUT_POST, "prodi");
$fakultas = filter_input(INPUT_POST, "fakultas");
$universitas = filter_input(INPUT_POST, "universitas");
$foto = filter_input(INPUT_POST, "foto");

header('content-type:application/json');
$jsonData = array();
if (isset($nrp) && !empty($nrp)) {
    $mahasiswaDao = new MahasiswaDaoImpl();
    $mahasiswa = new Mahasiswa();
    $mahasiswa->setNrp($nrp);
    $mahasiswa->setNama($nama);
    $mahasiswa->setFoto($foto);
    $mahasiswa->setProdi($prodi);
    $mahasiswa->setFakultas($fakultas);
    $mahasiswa->setUniversitas($universitas);
    $response = $mahasiswaDao->insertMahasiswa($mahasiswa);
    if ($response) {
        $jsonData['status'] = 1;
        $jsonData['message'] = "Add data success";
    } else {
        $jsonData['status'] = 2;
        $jsonData['message'] = "Error add data";
    }
} else {
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing nama mahasiswa";
}


echo json_encode($jsonData);
