<?php

class Mahasiswa
{

    // database connection and table name
    private $conn;
    private $table_name = "mahasiswa";

    public $nrp;
    public $nama;
    public $prodi;
    public $fakultas;
    public $universitas;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT
               * FROM mahasiswa";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nrp=:nrp, nama=:nama, prodi=:prodi,fakultas=:fakultas,universitas=:universitas";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nrp = htmlspecialchars(strip_tags($this->nrp));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->prodi = htmlspecialchars(strip_tags($this->prodi));
        $this->fakultas = htmlspecialchars(strip_tags($this->fakultas));
        $this->universitas = htmlspecialchars(strip_tags($this->universitas));

        // bind values
        $stmt->bindParam(":nrp", $this->nrp);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":prodi", $this->prodi);
        $stmt->bindParam(":fakultas", $this->fakultas);
        $stmt->bindParam(":universitas", $this->universitas);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
