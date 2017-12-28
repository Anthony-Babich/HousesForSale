<?php

namespace House\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * RentalDates
 *
 * @ORM\Table(name="rental_dates")
 * @ORM\Entity(repositoryClass="House\Bundle\Repository\RentalDatesRepository")
 */
class RentalDates
{
    public function __construct()
    {
        $this->setStartDate(new DateTime());
        $this->setStartDate(new DateTime());
        $this->setStartDate(new DateTime());
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
     * @var House
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\House", cascade={"persist"})
     * @ORM\JoinColumn(name="id_house", referencedColumnName="id")
     */
    private $idHouse;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

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
     * Set startDate
     *
     * @param DateTime $startDate
     *
     * @return RentalDates
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return DateTime|string|null
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get startDate
     *
     * @return DateTime|string|null
     */
    public function getStartDateFormat()
    {
        return $this->startDate->format('Y-m-d H:i:s');
    }

    /**
     * Set endDate
     *
     * @param DateTime $endDate
     *
     * @return RentalDates
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return DateTime|string|null
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Get endDate
     *
     * @return DateTime|string|null
     */
    public function getEndDateFormat()
    {
        return $this->endDate->format('Y-m-d H:i:s');
    }

    /**
     * @return House
     */
    public function getIdHouse()
    {
        return $this->idHouse;
    }

    /**
     * @param House $idHouse
     */
    public function setIdHouse(House $idHouse)
    {
        $this->idHouse = $idHouse;
    }
}