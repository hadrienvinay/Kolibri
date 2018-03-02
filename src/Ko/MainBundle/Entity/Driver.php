<?php

namespace Ko\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver
 *
 * @ORM\Table(name="driver")
 * @ORM\Entity(repositoryClass="Ko\MainBundle\Repository\DriverRepository")
 */
class Driver
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="driverId")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     *@ORM\OneToMany(targetEntity="Ko\MainBundle\Entity\Proposal", mappedBy="driverId")
     */
    private $proposalId;

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
     * @var string
     *
     * @ORM\Column(name="City", type="string", length=255,nullable=true)
     */
    private $city;

    /**
     * @var bool
     *
     * @ORM\Column(name="LicenceCheck", type="boolean",nullable=true)
     */
    private $licenceCheck;

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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Driver
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set licenceCheck
     *
     * @param boolean $licenceCheck
     *
     * @return Driver
     */
    public function setLicenceCheck($licenceCheck)
    {
        $this->licenceCheck = $licenceCheck;

        return $this;
    }

    /**
     * Get licenceCheck
     *
     * @return bool
     */
    public function getLicenceCheck()
    {
        return $this->licenceCheck;
    }


}

