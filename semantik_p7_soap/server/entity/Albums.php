<?php

class Albums implements JsonSerializable {
    private $idalbums;
    private $title;
    private $releasedate;
    private $producers;
    private $artists_idartists;
    private $cover;
    private $artists_name;
    

    /**
     * Get the value of cover
     */ 
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set the value of cover
     *
     * @return  self
     */ 
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get the value of artists_idartists
     */ 
    public function getArtists_idartists()
    {
        return $this->artists_idartists;
    }

    /**
     * Set the value of artists_idartists
     *
     * @return  self
     */ 
    public function setArtists_idartists($artists_idartists)
    {
        $this->artists_idartists = $artists_idartists;

        return $this;
    }

    /**
     * Get the value of producers
     */ 
    public function getProducers()
    {
        return $this->producers;
    }

    /**
     * Set the value of producers
     *
     * @return  self
     */ 
    public function setProducers($producers)
    {
        $this->producers = $producers;

        return $this;
    }

    /**
     * Get the value of releasedate
     */ 
    public function getReleasedate()
    {
        return $this->releasedate;
    }

    /**
     * Set the value of releasedate
     *
     * @return  self
     */ 
    public function setReleasedate($releasedate)
    {
        $this->releasedate = $releasedate;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of idalbums
     */ 
    public function getIdalbums()
    {
        return $this->idalbums;
    }

    /**
     * Set the value of idalbums
     *
     * @return  self
     */ 
    public function setIdalbums($idalbums)
    {
        $this->idalbums = $idalbums;

        return $this;
    }

    /**
     * Get the value of artists_name
     */ 
    public function getArtists_name()
    {
        return $this->artists_name;
    }

    /**
     * Set the value of artists_name
     *
     * @return  self
     */ 
    public function setArtists_name($artists_name)
    {
        $this->artists_name = $artists_name;

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}