<?php
class MahasiswaDaoImpl
{
    public function getMahasiswaData()
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * from mahasiswa";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Mahasiswa');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function getMahasiswaDataArray()
    {
        $link = PDOUtil::createConnection();
        $query = "SELECT * from mahasiswa";
        $result = $link->query($query);
        PDOUtil::closeConnection($link);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function insertMahasiswa(Mahasiswa $mahasiswa)
    {
        $result = 0;
        $link = PDOUtil::createConnection();

        $query = "INSERT into mahasiswa (nrp, nama, foto, prodi, fakultas, universitas) VALUES (?,?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mahasiswa->getNrp());
        $stmt->bindValue(2, $mahasiswa->getNama());
        $stmt->bindValue(3, $mahasiswa->getFoto());
        $stmt->bindValue(4, $mahasiswa->getProdi());
        $stmt->bindValue(5, $mahasiswa->getFakultas());
        $stmt->bindValue(6, $mahasiswa->getUniversitas());


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

}
