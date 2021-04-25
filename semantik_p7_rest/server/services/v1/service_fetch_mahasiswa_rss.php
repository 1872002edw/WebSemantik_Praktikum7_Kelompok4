<?php

include_once '../../entity/Mahasiswa.php';
include_once '../../dao/MahasiswaDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/xml');
$mahasiswaDao = new MahasiswaDaoImpl();
$list_mahasiswa = $mahasiswaDao->getMahasiswaDataArray();

// buat XML Document
$xmlDoc = new DOMDocument("1.0", "UTF-8");
$tabRss = $xmlDoc->appendChild($rssTag = $xmlDoc->createElement("rss"));
$rssTag->setAttribute('version', '2.0');
$tabChannel = $tabRss->appendChild($xmlDoc->createElement("channel"));
$tabTitle = $tabChannel->appendChild($xmlDoc->createElement("title", "Mahasiswa"));
$tabLink = $tabChannel->appendChild($xmlDoc->createElement("link", "http://www.praktikum.com/maranatha"));
$tabDescription = $tabChannel->appendChild($xmlDoc->createElement("description", "Isi detail data mahasiswa"));
foreach ($list_mahasiswa as $data) {
    if (!empty($data)) {
        $tabMahasiswa = $tabChannel->appendChild($xmlDoc->createElement("item"));
        foreach ($data as $key => $val) {
            $tabMahasiswa->appendChild($xmlDoc->createElement($key, $val));
        }
    }
}



//make output pretty
$xmlDoc->formatOutput = true;
echo ($xmlDoc->saveXML());
