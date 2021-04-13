<?php
function getMahasiswaData()
{
    $link = createConnection();
    $query = "SELECT * from mahasiswa";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}



function insertMahasiswa($nrp, $nama, $prodi, $fakultas, $universitas)
{
    $result = 0;
    $link = createConnection();
    $query = "INSERT into mahasiswa (nrp,nama,prodi,fakultas,universitas) VALUES (?,?,?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $nrp);
    $stmt->bindParam(2, $nama);
    $stmt->bindParam(3, $prodi);
    $stmt->bindParam(4, $fakultas);
    $stmt->bindParam(5, $universitas);
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
