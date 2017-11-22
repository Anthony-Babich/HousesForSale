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
    public function __construct()
    {
        $this->setCreated(new \DateTime());
    }

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
     * @ORM\Column(name="description", type="string", length=3000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="priceRent", type="float")
     */
    private $priceRent;

    /**
     * @var float
     *
     * @ORM\Column(name="priceSale", type="float")
     */
    private $priceSale;

    /**
     * @var SalesRent
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\SalesRent", cascade={"persist"})
     * @ORM\JoinColumn(name="id_sales_rent", referencedColumnName="id")
     */
    private $idSalesRent;

    /**
     * @var string street
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string latitude
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     */
    private $latitude;

    /**
     * @var string longitude
     *
     * @ORM\Column(name="longitude", type="string", length=255)
     */
    private $longitude;

    /**
     * @var string sq
     *
     * @ORM\Column(name="sq", type="string", length=255)
     */
    private $sq;

    /**
     * @var integer $countBath
     *
     * @ORM\Column(name="countBath", type="integer")
     */
    private $countBath;

    /**
     * @var integer $countBed
     *
     * @ORM\Column(name="countBed", type="integer")
     */
    private $countBed;

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
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToMany(targetEntity="House\Bundle\Entity\Images")
     * @ORM\JoinTable(name="house_image",
     *   joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName = "id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     * )
     */
    protected $images = array();

    /**
     * @ORM\ManyToMany(targetEntity="House\Bundle\Entity\ImagesSmall")
     * @ORM\JoinTable(name="house_imageSmall",
     *   joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName = "id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="imageSmall_id", referencedColumnName="id")}
     * )
     */
    protected $imagesSmall = array();

    /**
     * @ORM\ManyToMany(targetEntity="House\Bundle\Entity\AdDetails")
     * @ORM\JoinTable(name="house_addetails",
     *   joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName = "id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="addetails_id", referencedColumnName="id")}
     * )
     */
    protected $adDetails = array();

    /**
     * @ORM\ManyToMany(targetEntity="House\Bundle\Entity\Features")
     * @ORM\JoinTable(name="house_features",
     *   joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName = "id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="features_id", referencedColumnName="id")}
     * )
     */
    protected $features = array();

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param Features $array
     * @return House
     */
    public function addFeatures(Features $array)
    {
        $this->features[] = $array;
        return $this;
    }

    /**
     * @param Features $element
     * @return House
     */
    public function removeFeatures(Features $element)
    {
        $this->features->removeElement($element);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdDetails()
    {
        return $this->adDetails;
    }

    /**
     * @param AdDetails $array
     * @return House
     */
    public function addAdDetails(AdDetails $array)
    {
        $this->adDetails[] = $array;
        return $this;
    }

    /**
     * @param AdDetails $element
     * @return House
     */
    public function removeAdDetails(AdDetails $element)
    {
        $this->adDetails->removeElement($element);
        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return House
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime|string
     */
    public function getCreated()
    {
        return $this->created->format('Y-m-d');
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Images $array
     * @return House
     */
    public function addImages(Images $array)
    {
        $this->images[] = $array;
        return $this;
    }

    /**
     * @param Images $element
     * @return House
     */
    public function removeImages(Images $element)
    {
        $this->images->removeElement($element);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagesSmall()
    {
        return $this->images;
    }

    /**
     * @param ImagesSmall $array
     * @return House
     */
    public function addImagesSmall(ImagesSmall $array)
    {
        $this->images[] = $array;
        return $this;
    }

    /**
     * @param ImagesSmall $element
     * @return House
     */
    public function removeImagesSmall(ImagesSmall $element)
    {
        $this->images->removeElement($element);
        return $this;
    }

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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getSq(): string
    {
        return $this->sq;
    }

    /**
     * @param string $sq
     */
    public function setSq(string $sq)
    {
        $this->sq = $sq;
    }

    /**
     * @return int
     */
    public function getCountBath()
    {
        return $this->countBath;
    }

    /**
     * @param int $countBath
     */
    public function setCountBath(int $countBath)
    {
        $this->countBath = $countBath;
    }

    /**
     * @return int
     */
    public function getCountBed(): int
    {
        return $this->countBed;
    }

    /**
     * @param int $countBed
     */
    public function setCountBed(int $countBed)
    {
        $this->countBed = $countBed;
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
     * @return float
     */
    public function getPriceRent()
    {
        return $this->priceRent;
    }

    /**
     * @param float $priceRent
     */
    public function setPriceRent(float $priceRent)
    {
        $this->priceRent = $priceRent;
    }

    /**
     * @return float
     */
    public function getPriceSale()
    {
        return $this->priceSale;
    }

    /**
     * @param float $priceSale
     */
    public function setPriceSale(float $priceSale)
    {
        $this->priceSale = $priceSale;
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