<?php

namespace House\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdDetails
 *
 * @ORM\Table(name="ad_details")
 * @ORM\Entity(repositoryClass="House\Bundle\Repository\AdDetailsRepository")
 */
class AdDetails
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_ru", type="string", length=255)
     */
    private $nameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="name_ar", type="string", length=255)
     */
    private $nameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="feature", type="string", length=255)
     */
    private $feature;

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
     * Set name
     *
     * @param string $name
     *
     * @return AdDetails
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
     * Get name
     *
     * @return string
     */
    public function getNameFeature()
    {
        return $this->name . ': ' . $this->feature;
    }

    /**
     * Set nameRu
     *
     * @param string $nameRu
     *
     * @return AdDetails
     */
    public function setNameRu($nameRu)
    {
        $this->nameRu = $nameRu;

        return $this;
    }

    /**
     * Get nameRu
     *
     * @return string
     */
    public function getNameRu()
    {
        return $this->nameRu;
    }

    /**
     * Set nameAr
     *
     * @param string $nameAr
     *
     * @return AdDetails
     */
    public function setNameAr($nameAr)
    {
        $this->nameAr = $nameAr;

        return $this;
    }

    /**
     * Get nameAr
     *
     * @return string
     */
    public function getNameAr()
    {
        return $this->nameAr;
    }

    /**
     * Set feature
     *
     * @param string $feature
     *
     * @return AdDetails
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->id);
    }
}

