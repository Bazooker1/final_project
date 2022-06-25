<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $productName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\ManyToMany(targetEntity=Storage::class, inversedBy="products")
     */
    private $storages;

    /**
     * @ORM\ManyToMany(targetEntity=Provider::class, mappedBy="products")
     */
    private $providers;

    public function __construct()
    {
        $this->storages = new ArrayCollection();
        $this->providers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return Collection<int, Storage>
     */
    public function getStorages(): Collection
    {
        return $this->storages;
    }

    public function addStorage(Storage $storage): self
    {
        if (!$this->storages->contains($storage)) {
            $this->storages[] = $storage;
        }

        return $this;
    }

    public function removeStorage(Storage $storage): self
    {
        $this->storages->removeElement($storage);

        return $this;
    }

    /**
     * @return Collection<int, Provider>
     */
    public function getProviders(): Collection
    {
        return $this->providers;
    }

    public function addProvider(Provider $provider): self
    {
        if (!$this->providers->contains($provider)) {
            $this->providers[] = $provider;
            $provider->addProduct($this);
        }

        return $this;
    }

    public function removeProvider(Provider $provider): self
    {
        if ($this->providers->removeElement($provider)) {
            $provider->removeProduct($this);
        }

        return $this;
    }
    public function __toString(){
        return strval( $this->id." ".$this->productName);
    }
}
