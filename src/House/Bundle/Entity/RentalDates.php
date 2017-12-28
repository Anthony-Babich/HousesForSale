<?php

namespace House\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalDates
 *
 * @ORM\Table(name="rental_dates")
 * @ORM\Entity(repositoryClass="House\Bundle\Repository\RentalDatesRepository")
 */
class RentalDates
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
     * @var House
     *
     * @ORM\ManyToOne(targetEntity="House\Bundle\Entity\House", cascade={"persist"})
     * @ORM\JoinColumn(name="id_house", referencedColumnName="id")
     */
    private $idHouse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
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
     * @param \DateTime $startDate
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
     * @return \DateTime|string
     */
    public function getStartDate()
    {
        return $this->startDate->format('Y-m-d H:i:s');
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
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
     * @return \DateTime|string
     */
    public function getEndDate()
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