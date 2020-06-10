<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsRepository")
 */
class Clients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Placings", mappedBy="company")
     */
    private $placings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addedby;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

 

    public function __construct()
    {
        $this->placings = new ArrayCollection();
        $time = new \DateTime();
        $this->date = $time;
    }

    


    public function getId(): ?int
    {
        return $this->id;
    }

    

    /**
     * @return Collection|Placings[]
     */
    public function getPlacings(): Collection
    {
        return $this->placings;
    }

    public function addPlacing(Placings $placing): self
    {
        if (!$this->placings->contains($placing)) {
            $this->placings[] = $placing;
            $placing->setCompany($this);
        }

        return $this;
    }

    public function removePlacing(Placings $placing): self
    {
        if ($this->placings->contains($placing)) {
            $this->placings->removeElement($placing);
            // set the owning side to null (unless already changed)
            if ($placing->getCompany() === $this) {
                $placing->setCompany(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAddedby(): ?string
    {
        return $this->addedby;
    }

    public function setAddedby(string $addedby): self
    {
        $this->addedby = $addedby;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }





}
