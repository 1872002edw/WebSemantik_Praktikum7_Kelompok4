<?php

class AlbumsController
{
    public function index()
    {
        $command = filter_input(INPUT_GET, 'cmd');
        if (isset($command) && $command == 'del') {
            $aid = filter_input(INPUT_GET, 'aid');
            if (isset($aid)) {
                $album = $this->albumsDao->getAlbumsDataWhereIdIs($aid);
                unlink('uploads/' . $album->getCover());
                $result = $this->albumsDao->deleteAlbums($aid);
                if ($result) {
                    echo '<div class="bg-success">Data Successfully deleted</div>';
                } else {
                    echo '<div class="bg-error">Delete failed</div>';
                }
            }
        }

        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if ($submitPressed) {
            //get Data dari form
            $title = filter_input(INPUT_POST, "txtAlbumsTitle");
            $date = filter_input(INPUT_POST, "txtAlbumsReleaseDate");
            $date1 = str_replace('/', '-', $date);
            $releaseDate = date('Y-m-d', strtotime($date1));
            $producers = filter_input(INPUT_POST, "txtAlbumsProducers");
            $idartists = filter_input(INPUT_POST, "txtArtists");
            //buat object albums

            if (isset($_FILES['albumsCover']['name'])) {
                $targetDirectory = 'uploads/';
                $fileExtension = pathinfo($_FILES['albumsCover']['name'], PATHINFO_EXTENSION);
                $newFileName = $title . '.' . $fileExtension;
                $targetFile = $targetDirectory . $newFileName;
                if ($_FILES['albumsCover']['size'] > 1024 * 2048) {
                    echo '<div>Upload error. File size exceed 2MB</div>';
                } else {
                    move_uploaded_file($_FILES['albumsCover']['tmp_name'], $targetFile);
                }
            }
            if ($fileExtension == null) {
                $sendData = array('title' => $title, 'releasedate' => $releaseDate, 'producers' => $producers, 'artists_idartists' => $idartists);
                $wsResponse = Utility::curl_post(ApiService::ADD_ALBUMS_URL, $sendData);
                $result = json_decode($wsResponse);
            } else {
                $sendData = array('title' => $title, 'releasedate' => $releaseDate, 'producers' => $producers, 'artists_idartists' => $idartists, 'cover' => $newFileName);
                $wsResponse = Utility::curl_post(ApiService::ADD_ALBUMS_URL, $sendData);
                $result = json_decode($wsResponse);
            }
            if ($result) {
                echo '<div class="bg-success">Data Successfully added (Albums: ' . $title . ')</div>';
            } else {
                echo '<div class="bg-error">Error add data</div>';
            }
        }
        $wsResponse1 = Utility::curl_get(ApiService::ALL_ALBUMS_URL, array());
        $albums = json_decode($wsResponse1);
        $wsResponse2 = Utility::curl_get(ApiService::ALL_ARTISTS_URL, array());
        $artists = json_decode($wsResponse2);

        include_once 'albums.php';
    }

    public function update()
    {
        $aid = filter_input(INPUT_GET, "aid");
        if (isset($aid)) {
            $album = $this->albumsDao->getAlbumsDataWhereIdIs($aid);
            $artists = $this->artistsDao->getArtistsData();
        }
        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if ($submitPressed) {
            //get Data dari form
            $title = filter_input(INPUT_POST, "txtAlbumsTitle");
            $date = filter_input(INPUT_POST, "txtAlbumsReleaseDate");
            $date1 = str_replace('/', '-', $date);
            $releaseDate = date('Y-m-d', strtotime($date1));
            $producers = filter_input(INPUT_POST, "txtAlbumsProducers");
            $idartists = filter_input(INPUT_POST, "txtArtists");
            //buat data object
            $updatedAlbums = new Albums();
            $updatedAlbums->setIdalbums($album->getIdalbums());
            $updatedAlbums->setTitle($title);
            $updatedAlbums->setReleasedate($releaseDate);
            $updatedAlbums->setProducers($producers);
            $updatedAlbums->setArtists_idartists($idartists);
            //connect ke db
            if (isset($_FILES['albumsCover']['name'])) {
                $targetDirectory = 'uploads/';
                $fileExtension = pathinfo($_FILES['albumsCover']['name'], PATHINFO_EXTENSION);
                $newFileName = $title . '.' . $fileExtension;
                $targetFile = $targetDirectory . $newFileName;
                if ($_FILES['albumsCover']['size'] > 1024 * 2048) {
                    echo '<div>Upload error. File size exceed 2MB</div>';
                } else {
                    move_uploaded_file($_FILES['albumsCover']['tmp_name'], $targetFile);
                }
            }
            if ($fileExtension == null) {
                $this->albumsDao->updateAlbums($updatedAlbums);
            } else {
                $updatedAlbums->setCover($newFileName);
                $this->albumsDao->updateAlbums($updatedAlbums);
            }
        }
        include_once 'albums_update.php';
    }
}
