<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortRepository::class)
 * @ORM\Table(name="port",uniqueConstraints={@ORM\UniqueConstraint(name="portindicatif_unique",columns={"indicatif"})})
 */
class Port
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $indicatif;

    /**
     * @ORM\Column(name="lepays")
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(nullable=false,name="idpays")
     */
    private $lePays;

    /**
     * @ORM\OneToMany(targetEntity=AisShipType::class, mappedBy="lesPorts")
     * @ORM\JoinTable(name="porttypecompatible",joinColumns={@ORM\JoinColumn(name="idaistype",referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="idport",referencedColumnName="id")})
     */
    private $aisShipTypes;

    public function __construct()
    {
        $this->aisShipTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIndicatif(): ?string
    {
        return $this->indicatif;
    }

    public function setIndicatif(string $indicatif): self
    {
        $this->indicatif = $indicatif;

        return $this;
    }

    public function getLePays(): ?Pays
    {
        return $this->lePays;
    }

    public function setLePays(?Pays $lePays): self
    {
        $this->lePays = $lePays;

        return $this;
    }

    /**
     * @return Collection|AisShipType[]
     */
    public function getAisShipTypes(): Collection
    {
        return $this->aisShipTypes;
    }

    public function addAisShipType(AisShipType $aisShipType): self
    {
        if (!$this->aisShipTypes->contains($aisShipType)) {
            $this->aisShipTypes[] = $aisShipType;
            $aisShipType->setLesPorts($this);
        }

        return $this;
    }

    public function removeAisShipType(AisShipType $aisShipType): self
    {
        if ($this->aisShipTypes->removeElement($aisShipType)) {
            // set the owning side to null (unless already changed)
            if ($aisShipType->getLesPorts() === $this) {
                $aisShipType->setLesPorts(null);
            }
        }

        return $this;
    }
}
