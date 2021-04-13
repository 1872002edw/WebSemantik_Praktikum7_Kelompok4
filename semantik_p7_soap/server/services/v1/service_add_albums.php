<?php

include_once '../../entity/Mahasiswa.php';
include_once '../../dao/MahasiswaDaoImpl.php';
include_once '../../util/PDOUtil.php';


$title = filter_input(INPUT_POST, 'title');
$releasedate = filter_input(INPUT_POST, 'releasedate');
$producers = filter_input(INPUT_POST, 'producers');
$artists_idartists = filter_input(INPUT_POST,'artists_idartists');
$cover = filter_input(INPUT_POST,'cover');

header('content-type:application/json');
$jsonData = array();
if(isset($title) && !empty($title)){
    $albumsDao = new AlbumsDaoImpl();
    $album = new Albums();
    $album->setTitle($title);
    $album->setReleasedate($releasedate);
    $album->setProducers($producers);
    $album->setArtists_idartists($artists_idartists);
    $album->setCover($cover);
    $response = $albumsDao->insertAlbums($album);
    if($response) {
        $jsonData['status'] = 1;
        $jsonData['message'] = "Add data success";
    } else {
        $jsonData['status'] = 2;
        $jsonData['message'] = "Error add data";
    }
} else {
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing name title albums";
}


echo json_encode($jsonData);