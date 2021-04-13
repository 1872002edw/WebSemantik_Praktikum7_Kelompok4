<?php
function getAlbumsData()
{
    $link = createConnection();
    $query = "SELECT a.*, c.name from albums a JOIN artists c ON a.artists_idartists = c.idartists";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function getAlbumsDataWhereIdIs($aid)
{
    $link = createConnection();
    $query = "SELECT * FROM albums WHERE idalbums = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $aid);
    $stmt->execute();
    $result = $stmt->fetch();
    closeConnection($link);
    return $result;
}

function insertAlbums($title, $releaseDate, $producers, $artists, $cover = null)
{
    $result = 0;
    $link = createConnection();

    $query = "INSERT into albums (title, releasedate, producers, artists_idartists, cover) VALUES (?,?,?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $releaseDate);
    $stmt->bindParam(3, $producers);
    $stmt->bindParam(4, $artists);
    $stmt->bindParam(5, $cover);

    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}

function deleteAlbums($aid)
{
    $result = 0;
    $link = createConnection();
    $query = "DELETE FROM albums WHERE idalbums= ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $aid);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}

function updateAlbums($aid, $title, $releaseDate, $producers, $artists, $cover = null)
{
    $link = createConnection();
    if ($cover==null){
        $query = "UPDATE albums SET title=?, releasedate=?, producers=?, artists_idartists=?WHERE idalbums = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $releaseDate);
    $stmt->bindParam(3, $producers);
    $stmt->bindParam(4, $artists);
    $stmt->bindParam(5, $aid);
    }
    else {
        $query = "UPDATE albums SET title=?, releasedate=?, producers=?, artists_idartists=?, cover=? WHERE idalbums = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $releaseDate);
    $stmt->bindParam(3, $producers);
    $stmt->bindParam(4, $artists);
    $stmt->bindParam(5, $cover);
    $stmt->bindParam(6, $aid);
    }

    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    header("location:index.php?navito=albums");
}
