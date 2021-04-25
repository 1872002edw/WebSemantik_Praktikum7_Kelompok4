<?php

include_once '../../entity/Mahasiswa.php';
include_once '../../dao/MahasiswaDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');
$mahasiswaDao = new MahasiswaDaoImpl();
$list_mahasiswa = $mahasiswaDao->getMahasiswaDataArray();

// buat XML Document
$nTriples = '';

$URI = 'http://www.praktikum.com/maranatha';

foreach ($list_mahasiswa as $data) {
    if (!empty($data)) {
        foreach ($data as $key => $val) {
            if ($key != 'nrp') {
                $nTriples .= '<' . $URI . '/' . $data['nrp'] . '>';
                $nTriples .= ' <' . $URI . '#has' . $key . '>';
                $nTriples .= ' "' . $val . '" .' . "\n";
            }
        }
        $nTriples .= "\n";
    }
}

echo ($nTriples);
