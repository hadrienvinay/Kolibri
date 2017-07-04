<?php

namespace Ko\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Ko\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
        /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
         * @ORM\OneToMany(targetEntity="Ko\ProjectBundle\Entity\Annonce", mappedBy="author")
     */
    protected $annonces;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    protected $adress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="datetime")
     */
    protected $creation;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }
}
