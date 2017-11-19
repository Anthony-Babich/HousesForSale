<?php

namespace House\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * House
 *
 * @ORM\Table(name="house")
 * @ORM\Entity(repositoryClass="House\Bundle\Repository\HouseRepository")
 */
class House
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var SalesRent
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\SalesRent", cascade={"persist"})
     * @ORM\JoinColumn(name="id_sales_rent", referencedColumnName="id")
     */
    private $idSalesRent;

    /**
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\Type", cascade={"persist"})
     * @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     */
    private $idType;

    /**
     * @var Bedrooms
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\Bedrooms", cascade={"persist"})
     * @ORM\JoinColumn(name="id_bedrooms", referencedColumnName="id")
     */
    private $idBedrooms;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return House
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return House
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return House
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return SalesRent
     */
    public function getIdSalesRent()
    {
        return $this->idSalesRent;
    }

    /**
     * @param SalesRent $idSalesRent
     */
    public function setIdSalesRent(SalesRent $idSalesRent)
    {
        $this->idSalesRent = $idSalesRent;
    }

    /**
     * @return Type
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @param Type $idType
     */
    public function setIdType(Type $idType)
    {
        $this->idType = $idType;
    }

    /**
     * @return Bedrooms
     */
    public function getIdBedrooms()
    {
        return $this->idBedrooms;
    }

    /**
     * @param Bedrooms $idBedrooms
     */
    public function setIdBedrooms(Bedrooms $idBedrooms)
    {
        $this->idBedrooms = $idBedrooms;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->id);
    }
}

