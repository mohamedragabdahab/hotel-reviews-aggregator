<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="id")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parentId;

    /**
     * @ORM\Column(type="integer")
     */
    public $rooms;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param mixed $rooms
     * @return Hotel
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId): void
    {
        $this->parentId = $parentId;
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
