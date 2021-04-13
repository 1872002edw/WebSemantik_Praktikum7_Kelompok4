<?php
function getArtistsData()
{
    $link = createConnection();
    $query = "SELECT * from artists";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function getArtistsDataWhereIdIs($aid)
{
    $link = createConnection();
    $query = "SELECT * FROM artists WHERE idartists = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $aid);
    $stmt->execute();
    $result = $stmt->fetch();
    closeConnection($link);
    return $result;
}

function insertArtists($artistsName, $artistsDebut, $artistsCompany)
{
    $result = 0;
    $link = createConnection();
    $query = "INSERT into artists (name, debut, company) VALUES (?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $artistsName);
    $stmt->bindParam(2, $artistsDebut);
    $stmt->bindParam(3, $artistsCompany);
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

function deleteArtists($aid)
{
    $result=0;
    $link = createConnection();
    $query = "DELETE FROM artists WHERE idartists= ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $aid);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}

function updateArtists($aid,$artistsName,$artistsDebut,$artistsCompany){
    $link=createConnection();
    $query = "UPDATE artists SET name = ? ,debut = ?, company = ? WHERE idartists = ? ";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $artistsName);
    $stmt->bindParam(2, $artistsDebut);
    $stmt->bindParam(3, $artistsCompany);
    $stmt->bindParam(4, $aid);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    header("location:index.php?navito=artists");
}