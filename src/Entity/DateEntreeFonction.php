<?php
namespace App\Entity;

class DateEntreeFonction {
    private $date_entre_fonction;

    /**
     * Get the value of date_entre_fonction
     */ 
    public function getDate_entre_fonction()
    {
        return $this->date_entre_fonction;
    }

    /**
     * Set the value of date_entre_fonction
     *
     * @return  self
     */ 
    public function setDate_entre_fonction(\DateTime $date_entre_fonction)
    {
        $this->date_entre_fonction = $date_entre_fonction;

        return $this;
    }
}