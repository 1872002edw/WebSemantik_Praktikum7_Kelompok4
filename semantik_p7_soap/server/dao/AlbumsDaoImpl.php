<?php
class AlbumsDaoImpl
{
    public function getAlbumsData()
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT a.*, c.name AS artists_name FROM albums a JOIN artists c ON a.artists_idartists = c.idartists";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Albums');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    /**
     * @param $aid
     * @return Albums
     */
    public function getAlbumsDataWhereIdIs($aid)
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM albums WHERE idalbums = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $aid);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Albums');
    }

    public function insertAlbums(Albums $albums)
    {
        $result = 0;
        $link = PDOUtil::createConnection();

        $query = "INSERT into albums (title, releasedate, producers, artists_idartists, cover) VALUES (?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $albums->getTitle());
        $stmt->bindValue(2, $albums->getReleasedate());
        $stmt->bindValue(3, $albums->getProducers());
        $stmt->bindValue(4, $albums->getArtists_idartists());
        $stmt->bindValue(5, $albums->getCover());

        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function deleteAlbums($aid)
    {
        $result = 0;
        $link = PDOUtil::createConnection();
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
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function updateAlbums(Albums $albums)
    {
        $link = PDOUtil::createConnection();
        if ($albums->getCover() == null) {
            $query = "UPDATE albums SET title=?, releasedate=?, producers=?, artists_idartists=? WHERE idalbums = ?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $albums->getTitle());
            $stmt->bindValue(2, $albums->getReleasedate());
            $stmt->bindValue(3, $albums->getProducers());
            $stmt->bindValue(4, $albums->getArtists_idartists());
            $stmt->bindValue(5, $albums->getIdalbums());
        } else {
            $query = "UPDATE albums SET title=?, releasedate=?, producers=?, artists_idartists=?, cover=? WHERE idalbums = ?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $albums->getTitle());
            $stmt->bindValue(2, $albums->getReleasedate());
            $stmt->bindValue(3, $albums->getProducers());
            $stmt->bindValue(4, $albums->getArtists_idartists());
            $stmt->bindValue(5, $albums->getCover());
            $stmt->bindValue(6, $albums->getIdalbums());
        }

        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        header("location:index.php?navito=albums");
    }
}
