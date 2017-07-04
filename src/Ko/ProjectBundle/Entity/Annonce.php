<?php

namespace Ko\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="Ko\ProjectBundle\Repository\AnnonceRepository")
 */
class Annonce
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
     * @ORM\ManyToOne(targetEntity="Ko\UserBundle\Entity\User", inversedBy="annonces")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="startPlace", type="string", length=255)
     */
    private $startPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="arrivalPlace", type="string", length=255)
     */
    private $arrivalPlace;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Annonce
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set startPlace
     *
     * @param string $startPlace
     * @return Annonce
     */
    public function setStartPlace($startPlace)
    {
        $this->startPlace = $startPlace;

        return $this;
    }

    /**
     * Get startPlace
     *
     * @return string 
     */
    public function getStartPlace()
    {
        return $this->startPlace;
    }

    /**
     * Set arrivalPlace
     *
     * @param string $arrivalPlace
     * @return Annonce
     */
    public function setArrivalPlace($arrivalPlace)
    {
        $this->arrivalPlace = $arrivalPlace;

        return $this;
    }

    /**
     * Get arrivalPlace
     *
     * @return string 
     */
    public function getArrivalPlace()
    {
        return $this->arrivalPlace;
    }
}
