<?php

namespace App\Model;

class Mesure 
{
    protected int $length;
    protected int $height;
    protected int $width;
    protected int $net_weight;
    protected int $gross_weight;


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
}