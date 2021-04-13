<?php

include_once '../../entity/Albums.php';
include_once '../../dao/AlbumsDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');
$albumsDao = new AlbumsDaoImpl();
$albums = $albumsDao->getAlbumsData();

echo json_encode($albums);