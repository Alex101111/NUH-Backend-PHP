<?php

namespace App\Model;


class Commande 
{
    protected int  $id_commande;
   protected string $commande_status;
   protected string $commande_comment;
   protected string $tracking_number;

   

    /**
     * Get the value of id_commande
     *
     * @return int
     */
    public function getIdCommande(): int
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     *
     * @param int $id_commande
     *
     * @return self
     */
    public function setIdCommande(int $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

   /**
    * Get the value of commande_status
    *
    * @return string
    */
   public function getCommandeStatus(): string
   {
      return $this->commande_status;
   }

   /**
    * Set the value of commande_status
    *
    * @param string $commande_status
    *
    * @return self
    */
   public function setCommandeStatus(string $commande_status): self
   {
      $this->commande_status = $commande_status;

      return $this;
   }

   /**
    * Get the value of commande_comment
    *
    * @return string
    */
   public function getCommandeComment(): string
   {
      return $this->commande_comment;
   }

   /**
    * Set the value of commande_comment
    *
    * @param string $commande_comment
    *
    * @return self
    */
   public function setCommandeComment(string $commande_comment): self
   {
      $this->commande_comment = $commande_comment;

      return $this;
   }

   /**
    * Get the value of tracking_number
    *
    * @return string
    */
   public function getTrackingNumber(): string
   {
      return $this->tracking_number;
   }

   /**
    * Set the value of tracking_number
    *
    * @param string $tracking_number
    *
    * @return self
    */
   public function setTrackingNumber(string $tracking_number): self
   {
      $this->tracking_number = $tracking_number;

      return $this;
   }
}


