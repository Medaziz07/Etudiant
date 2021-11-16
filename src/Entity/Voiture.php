<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
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
    private $Serie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Date_Mise_En_Marche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Modele;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="voiture")
     */
    private $voitureL;

    public function __construct()
    {
        $this->voitureL = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->Serie;
    }

    public function setSerie(string $Serie): self
    {
        $this->Serie = $Serie;

        return $this;
    }

    public function getDateMiseEnMarche(): ?string
    {
        return $this->Date_Mise_En_Marche;
    }

    public function setDateMiseEnMarche(string $Date_Mise_En_Marche): self
    {
        $this->Date_Mise_En_Marche = $Date_Mise_En_Marche;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getVoitureL(): Collection
    {
        return $this->voitureL;
    }

    public function addVoitureL(Location $voitureL): self
    {
        if (!$this->voitureL->contains($voitureL)) {
            $this->voitureL[] = $voitureL;
            $voitureL->setVoiture($this);
        }

        return $this;
    }

    public function removeVoitureL(Location $voitureL): self
    {
        if ($this->voitureL->removeElement($voitureL)) {
            // set the owning side to null (unless already changed)
            if ($voitureL->getVoiture() === $this) {
                $voitureL->setVoiture(null);
            }
        }

        return $this;
    }
}
