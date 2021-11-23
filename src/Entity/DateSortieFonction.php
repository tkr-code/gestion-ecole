<?php
namespace App\Entity;

class DateSortieFonction {
    private $date_sortie_fonction;

    /**
     * Get the value of date_sortie_fonction
     */ 
    public function getDate_sortie_fonction()
    {
        return $this->date_sortie_fonction;
    }

    /**
     * Set the value of date_sortie_fonction
     *
     * @return  self
     */ 
    public function setDate_sortie_fonction(\DateTime $date_sortie_fonction)
    {
        $this->date_sortie_fonction = $date_sortie_fonction;

        return $this;
    }
}