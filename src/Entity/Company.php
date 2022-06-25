<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
    private $companyName;

    /**
     * @ORM\OneToMany(targetEntity=Ship::class, mappedBy="company")
     */
    private $companyShips;

    /**
     * @ORM\OneToOne(targetEntity=Provider::class, mappedBy="companies", cascade={"persist", "remove"})
     */
    private $provider;

    public function __construct()
    {
        $this->companyShips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return Collection<int, Ship>
     */
    public function getCompanyShips(): Collection
    {
        return $this->companyShips;
    }

    public function addCompanyShip(Ship $companyShip): self
    {
        if (!$this->companyShips->contains($companyShip)) {
            $this->companyShips[] = $companyShip;
            $companyShip->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyShip(Ship $companyShip): self
    {
        if ($this->companyShips->removeElement($companyShip)) {
            // set the owning side to null (unless already changed)
            if ($companyShip->getCompany() === $this) {
                $companyShip->setCompany(null);
            }
        }

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        // unset the owning side of the relation if necessary
        if ($provider === null && $this->provider !== null) {
            $this->provider->setCompanies(null);
        }

        // set the owning side of the relation if necessary
        if ($provider !== null && $provider->getCompanies() !== $this) {
            $provider->setCompanies($this);
        }

        $this->provider = $provider;

        return $this;
    }
    public function __toString(){
        return strval( $this->id." ".$this->companyName);
    }
}
