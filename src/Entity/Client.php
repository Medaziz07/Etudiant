<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="client")
     */
    private $locationsC;

    public function __construct()
    {
        $this->locationsC = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocationsC(): Collection
    {
        return $this->locationsC;
    }

    public function addLocationsC(Location $locationsC): self
    {
        if (!$this->locationsC->contains($locationsC)) {
            $this->locationsC[] = $locationsC;
            $locationsC->setClient($this);
        }

        return $this;
    }

    public function removeLocationsC(Location $locationsC): self
    {
        if ($this->locationsC->removeElement($locationsC)) {
            // set the owning side to null (unless already changed)
            if ($locationsC->getClient() === $this) {
                $locationsC->setClient(null);
            }
        }

        return $this;
    }
}
