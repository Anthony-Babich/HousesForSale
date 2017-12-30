<?php

namespace House\Bundle\Entity\Search;

class House
{
    /**
     * @var string
     */
    protected $bedrooms;

    /**
     * @var string
     */
    protected $salesrent;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $price;

    /**
     * @return string
     */
    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    /**
     * @param string $bedrooms
     * @return House
     */
    public function setBedrooms(string $bedrooms)
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalesrent()
    {
        return $this->salesrent;
    }

    /**
     * @param string $salesrent
     * @return House
     */
    public function setSalesrent(string $salesrent)
    {
        $this->salesrent = $salesrent;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return House
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return House
     */
    public function setPrice(string $price)
    {
        $this->price = $price;

        return $this;
    }
}