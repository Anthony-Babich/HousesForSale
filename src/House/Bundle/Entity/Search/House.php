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
    protected $bathrooms;

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
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    /**
     * @param string $bathrooms
     * @return House
     */
    public function setBathrooms(string $bathrooms)
    {
        $this->bathrooms = $bathrooms;

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