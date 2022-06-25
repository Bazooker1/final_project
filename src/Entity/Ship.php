<?php

namespace App\Entity;

use App\Repository\ShipRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShipRepository::class)
 */
class Ship
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shipName;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxWeight;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="companyShips")
     */
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShipName(): ?string
    {
        return $this->shipName;
    }

    public function setShipName(string $shipName): self
    {
        $this->shipName = $shipName;

        return $this;
    }

    public function getMaxWeight(): ?int
    {
        return $this->maxWeight;
    }

    public function setMaxWeight(int $maxWeight): self
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
        public function __toString(){
            return strval( $this->id." ".$this->shipName);
    }
}
