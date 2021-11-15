<?php
namespace App\Entity;
/**Cette classe n'est pas reliee en base de donnes, elle est la juste pour aboutir à une fin precise */
class MonChoix{
    private  $choix;

    /**
     * Get the value of choix
     */ 
    public function getChoix()
    {
        return $this->choix;
    }

    /**
     * Set the value of choix
     *
     * @return  self
     */ 
    public function setChoix($choix)
    {
        $this->choix = $choix;

        return $this;
    }
}