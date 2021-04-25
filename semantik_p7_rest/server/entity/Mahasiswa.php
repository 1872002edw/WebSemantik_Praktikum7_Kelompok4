<?php
class Mahasiswa implements JsonSerializable{
    private $nrp;
    private $nama;
    private $foto;
    private $prodi;
    private $fakultas;
    private $universitas;


    /**
     * Get the value of nrp
     */ 
    public function getNrp()
    {
        return $this->nrp;
    }

    /**
     * Set the value of nrp
     *
     * @return  self
     */ 
    public function setNrp($nrp)
    {
        $this->nrp = $nrp;

        return $this;
    }

    /**
     * Get the value of nama
     */ 
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set the value of nama
     *
     * @return  self
     */ 
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of prodi
     */ 
    public function getProdi()
    {
        return $this->prodi;
    }

    /**
     * Set the value of prodi
     *
     * @return  self
     */ 
    public function setProdi($prodi)
    {
        $this->prodi = $prodi;

        return $this;
    }

    /**
     * Get the value of fakultas
     */ 
    public function getFakultas()
    {
        return $this->fakultas;
    }

    /**
     * Set the value of fakultas
     *
     * @return  self
     */ 
    public function setFakultas($fakultas)
    {
        $this->fakultas = $fakultas;

        return $this;
    }

    /**
     * Get the value of universitas
     */ 
    public function getUniversitas()
    {
        return $this->universitas;
    }

    /**
     * Set the value of universitas
     *
     * @return  self
     */ 
    public function setUniversitas($universitas)
    {
        $this->universitas = $universitas;

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
