<?php

namespace Ko\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Ko\MainBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="Ko\MainBundle\Entity\Proposal", inversedBy="messageId")
     * @ORM\JoinColumn(name="proposal_id", referencedColumnName="id")
     */
    private $proposalId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="messageId")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $senderId;

    /**
     * @var string
     *
     * @ORM\Column(name="Message", type="string", length=255)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;


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
     * Set senderId
     *
     * @param integer $senderId
     *
     * @return Message
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Get senderId
     *
     * @return int
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
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
}

