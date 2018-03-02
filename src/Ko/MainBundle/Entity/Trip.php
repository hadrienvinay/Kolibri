<?php

namespace Ko\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trip
 *
 * @ORM\Table(name="trip")
 * @ORM\Entity(repositoryClass="Ko\MainBundle\Repository\TripRepository")
 */
class Trip
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
     * @ORM\ManyToOne(targetEntity="Ko\MainBundle\Entity\Producer", inversedBy="tripId")
     * @ORM\JoinColumn(name="producer_id", referencedColumnName="id")
     */
    private $producerId;

    /**
     *@ORM\OneToMany(targetEntity="Ko\MainBundle\Entity\Proposal", mappedBy="tripId")
     */
    private $proposalId;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude_start", type="float", nullable=true)
     */
    private $latitudeStart;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude_start", type="float", nullable=true)
     */
    private $longitudeStart;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude_end", type="float", nullable=true)
     */
    private $latitudeEnd;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude_end", type="float", nullable=true)
     */
    private $longitudeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateBegin", type="datetime",nullable=true)
     */
    private $dateBegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEnd", type="datetime",nullable=true)
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HourOpen", type="time",nullable=true)
     */
    private $hourOpen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HourClose", type="time",nullable=true)
     */
    private $hourClose;

    /**
     * @var int
     *
     * @ORM\Column(name="SizeCar", type="integer",nullable=true)
     */
    private $sizeCar;

    /**
     * @var int
     *
     * @ORM\Column(name="BigPack", type="integer",nullable=true)
     */
    private $bigPack;

    /**
     * @var int
     *
     * @ORM\Column(name="SmallPack", type="integer",nullable=true)
     */
    private $smallPack;

    /**
     * @var int
     *
     * @ORM\Column(name="MedPack", type="integer",nullable=true)
     */
    private $medPack;

    /**
     * @var string
     *
     * @ORM\Column(name="AddressDeparture", type="string", length=255, nullable=true)
     */
    private $addressDeparture;

    /**
     * @var string
     *
     * @ORM\Column(name="AddressArrival", type="string", length=255, nullable=true)
     */
    private $addressArrival;

    /**
     * @var string
     *
     * @ORM\Column(name="TypeProduct", type="string", length=255, nullable=true)
     */
    private $typeProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return string
     */
    public function getAddressDeparture()
    {
        return $this->addressDeparture;
    }

    /**
     * @param string $addressDeparture
     */
    public function setAddressDeparture($addressDeparture)
    {
        $this->addressDeparture = $addressDeparture;
    }

    /**
     * @return string
     */
    public function getAddressArrival()
    {
        return $this->addressArrival;
    }

    /**
     * @param string $addressArrival
     */
    public function setAddressArrival($addressArrival)
    {
        $this->addressArrival = $addressArrival;
    }

    /**
     * @return string
     */
    public function getTypeProduct()
    {
        return $this->typeProduct;
    }

    /**
     * @return float
     */
    public function getLatitudeStart()
    {
        return $this->latitudeStart;
    }

    /**
     * @param float $latitudeStart
     */
    public function setLatitudeStart($latitudeStart)
    {
        $this->latitudeStart = $latitudeStart;
    }

    /**
     * @return float
     */
    public function getLongitudeStart()
    {
        return $this->longitudeStart;
    }

    /**
     * @param float $longitudeStart
     */
    public function setLongitudeStart($longitudeStart)
    {
        $this->longitudeStart = $longitudeStart;
    }

    /**
     * @return float
     */
    public function getLatitudeEnd()
    {
        return $this->latitudeEnd;
    }

    /**
     * @param float $latitudeEnd
     */
    public function setLatitudeEnd($latitudeEnd)
    {
        $this->latitudeEnd = $latitudeEnd;
    }

    /**
     * @return float
     */
    public function getLongitudeEnd()
    {
        return $this->longitudeEnd;
    }

    /**
     * @param float $longitudeEnd
     */
    public function setLongitudeEnd($longitudeEnd)
    {
        $this->longitudeEnd = $longitudeEnd;
    }



    /**
     * @param string $typeProduct
     */
    public function setTypeProduct($typeProduct)
    {
        $this->typeProduct = $typeProduct;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getHourOpen()
    {
        return $this->hourOpen;
    }

    /**
     * @param int $hourOpen
     */
    public function setHourOpen($hourOpen)
    {
        $this->hourOpen = $hourOpen;
    }

    /**
     * @return \DateTime
     */
    public function getHourClose()
    {
        return $this->hourClose;
    }

    /**
     * @param int $hourClose
     */
    public function setHourClose($hourClose)
    {
        $this->hourClose = $hourClose;
    }



    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return mixed
     */
    public function getProducerId()
    {
        return $this->producerId;
    }

    /**
     * @param mixed $producerId
     */
    public function setProducerId($producerId)
    {
        $this->producerId = $producerId;
    }

    /**
     * @return mixed
     */
    public function getProposalId()
    {
        return $this->proposalId;
    }

    /**
     * @param mixed $proposalId
     */
    public function setProposalId($proposalId)
    {
        $this->proposalId = $proposalId;
    }

    /**
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     *
     * @return Trip
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * @return int
     */
    public function getSizeCar()
    {
        return $this->sizeCar;
    }

    /**
     * @param int $sizeCar
     */
    public function setSizeCar($sizeCar)
    {
        $this->sizeCar = $sizeCar;
    }

    /**
     * @return int
     */
    public function getBigPack()
    {
        return $this->bigPack;
    }

    /**
     * @param int $bigPack
     */
    public function setBigPack($bigPack)
    {
        $this->bigPack = $bigPack;
    }

    /**
     * @return int
     */
    public function getSmallPack()
    {
        return $this->smallPack;
    }

    /**
     * @param int $smallPack
     */
    public function setSmallPack($smallPack)
    {
        $this->smallPack = $smallPack;
    }

    /**
     * @return int
     */
    public function getMedPack()
    {
        return $this->medPack;
    }

    /**
     * @param int $medPack
     */
    public function setMedPack($medPack)
    {
        $this->medPack = $medPack;
    }
}


