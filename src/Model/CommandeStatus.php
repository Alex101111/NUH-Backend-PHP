<?php

namespace App\Model;

class CommandeStatus 
{
    protected int $id_user;
    protected int $id_commande;
    protected string $name;
    protected string $surname;
    protected string $transport_type;
    protected string $departure;
    protected string $destination;
    protected string $container_type;
    protected int $length;
    protected int $height;
    protected int $width;
    protected int $net_weight;
    protected int $gross_weight;
    protected string $commande_status;
    protected string $commande_comment;
    protected string $quote_date;
    protected string $tracking_number;
    protected string $commentary;



    public function toArray(): array
{
    return [
        "id_user" => $this->id_user,
        "id_commande" => $this->id_commande,
        "name" => $this->name,
        "surname" => $this->surname,
        "transport_type" => $this->transport_type,
        "departure" => $this->departure,
        "destination" => $this->destination,
        "container_type" => $this->container_type,
        "length" => $this->length,
        "height" => $this->height,
        "width" => $this->width,
        "net_weight" => $this->net_weight,
        "gross_weight" => $this->gross_weight,
        "commande_status" => $this->commande_status,
        "commande_comment" => $this->commande_comment,
        "quote_date" => $this->quote_date,
        "commentary" => $this->commentary,
        // "tracking_number" => $this->tracking_number
    ];
}


// public static function fromArray(array $CommandeStatus): CommandeStatus
// {
//     $a = new CommandeStatus();
//     return $a->setTransportType($CommandeStatus['transport_type'])
//     ->setContainerType($CommandeStatus['container_type'])
//     ->setLength($CommandeStatus['length'])
//     ->setHeight($CommandeStatus['height'])
//     ->setWidth($CommandeStatus['width'])
//     ->setNetWeight($CommandeStatus['net_weight'])
//     ->setGrossWeight($CommandeStatus['gross_weight'])
//     ->setCommandeStatus($CommandeStatus['commande_status'])
//     ->setCommandeComment($CommandeStatus['commande_comment'])
//     ->setCommentary($CommandeStatus['commentary']);
// }
    /**
     * Get the value of id_user
     *
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @param int $id_user
     *
     * @return self
     */
    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @param string $surname
     *
     * @return self
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of transport_type
     *
     * @return string
     */
    public function getTransportType(): string
    {
        return $this->transport_type;
    }

    /**
     * Set the value of transport_type
     *
     * @param string $transport_type
     *
     * @return self
     */
    public function setTransportType(string $transport_type): self
    {
        $this->transport_type = $transport_type;

        return $this;
    }

    /**
     * Get the value of departure
     *
     * @return string
     */
    public function getDeparture(): string
    {
        return $this->departure;
    }

    /**
     * Set the value of departure
     *
     * @param string $departure
     *
     * @return self
     */
    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get the value of destination
     *
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * Set the value of destination
     *
     * @param string $destination
     *
     * @return self
     */
    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get the value of container_type
     *
     * @return string
     */
    public function getContainerType(): string
    {
        return $this->container_type;
    }

    /**
     * Set the value of container_type
     *
     * @param string $container_type
     *
     * @return self
     */
    public function setContainerType(string $container_type): self
    {
        $this->container_type = $container_type;

        return $this;
    }

    /**
     * Get the value of length
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @param int $length
     *
     * @return self
     */
    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of height
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @param int $height
     *
     * @return self
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of width
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @param int $width
     *
     * @return self
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of net_weight
     *
     * @return int
     */
    public function getNetWeight(): int
    {
        return $this->net_weight;
    }

    /**
     * Set the value of net_weight
     *
     * @param int $net_weight
     *
     * @return self
     */
    public function setNetWeight(int $net_weight): self
    {
        $this->net_weight = $net_weight;

        return $this;
    }

    /**
     * Get the value of gross_weight
     *
     * @return int
     */
    public function getGrossWeight(): int
    {
        return $this->gross_weight;
    }

    /**
     * Set the value of gross_weight
     *
     * @param int $gross_weight
     *
     * @return self
     */
    public function setGrossWeight(int $gross_weight): self
    {
        $this->gross_weight = $gross_weight;

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
     * Get the value of quote_date
     *
     * @return string
     */
    public function getQuoteDate(): string
    {
        return $this->quote_date;
    }

    /**
     * Set the value of quote_date
     *
     * @param string $quote_date
     *
     * @return self
     */
    public function setQuoteDate(string $quote_date): self
    {
        $this->quote_date = $quote_date;

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
     * Get the value of commentary
     */ 
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Set the value of commentary
     *
     * @return  self
     */ 
    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;

        return $this;
    }
}