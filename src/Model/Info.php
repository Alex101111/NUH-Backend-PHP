<?php

namespace App\Model;

class Info
{
    protected string $transport_type;
    protected string $departure;
    protected string $destination;
    protected string $container_type;
    protected string $commentary;
    

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
     * Get the value of commentary
     *
     * @return string
     */
    public function getCommentary(): string
    {
        return $this->commentary;
    }

    /**
     * Set the value of commentary
     *
     * @param string $commentary
     *
     * @return self
     */
    public function setCommentary(string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }
}