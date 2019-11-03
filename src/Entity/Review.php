<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="hotel_id", type="integer")
     */
    private $hotelId;

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @var \DateTime
     * @Gedmo\Mapping\Annotation\Timestampable(on="create")
     * @Doctrine\ORM\Mapping\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Mapping\Annotation\Timestampable(on="update")
     * @Doctrine\ORM\Mapping\Column(type="datetime", name="updated_at", options={"default"="1970-01-01 00:00:00"})
     */
    protected $updatedAt;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getHotelId()
    {
        return $this->hotelId;
    }

    /**
     * @param mixed $hotelId
     * @return Review
     */
    public function setHotelId($hotelId)
    {
        $this->hotelId = $hotelId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Review
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return Review
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
