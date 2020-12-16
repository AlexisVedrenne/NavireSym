<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NavireRepository::class)
 * @ORM\Table(name="navire",uniqueConstraints={@ORM\UniqueConstraint(name="mmsi_unique",columns={"mmsi"})})
 */
class Navire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7,name="imo",unique=true)
     * @Assert\Regex(pattern="/[1-9][0-9]{6}/",
     * message="Le numéro IMO doit comporter 6 chiffres")
     */
    private $numImo;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=3,max=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=9,name="mmsi")
     * @Assert\Regex(pattern="/[1-9][0-9]{8}/",
     * message="Le numéro MMSI doit comporter 8 chiffres")
     */
    private $numMMSI;

    /**
     * @ORM\Column(type="string", length=10,name="indicatifappel")
     */
    private $indicatifAppel;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eta;

    /**
     * @ORM\Column(name="letype")
     * @ORM\ManyToMany(targetEntity=AisShipType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $leType;

    /**
     * @ORM\Column(name="lepavillon")
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(name="idpays",nullable=false)
     */
    private $lePavillon;

    /**
     * @ORM\ManyToOne(targetEntity=Port::class, inversedBy="naviresAttendus",cascade={"persist"})
     * @ORM\JoinColumn(name="idportdestination",nullable=true)
     */
    private $portDestination;

    /**
     * @ORM\OneToMany(targetEntity=Escale::class, mappedBy="leNavire", orphanRemoval=true)
     */
    private $lesEscales;

    /**
     * @ORM\Column(type="integer")
     */
    private $longueur;

    /**
     * @ORM\Column(type="integer")
     */
    private $largeur;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=1)
     */
    private $triantdeau;

    

    public function __construct()
    {
        $this->lesEscales = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumImo(): ?int
    {
        return $this->numImo;
    }

    public function setNumImo(int $numImo): self
    {
        $this->numImo = $numImo;

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

    public function getNumMMSI(): ?int
    {
        return $this->numMMSI;
    }

    public function setNumMMSI(int $numMMSI): self
    {
        $this->numMMSI = $numMMSI;

        return $this;
    }

    public function getIndicatifAppel(): ?string
    {
        return $this->indicatifAppel;
    }

    public function setIndicatifAppel(string $indicatifAppel): self
    {
        $this->indicatifAppel = $indicatifAppel;

        return $this;
    }

    public function getEta(): ?\DateTimeInterface
    {
        return $this->eta;
    }

    public function setEta(?\DateTimeInterface $eta): self
    {
        $this->eta = $eta;

        return $this;
    }

    public function getLeType(): ?AisShipType
    {
        return $this->leType;
    }

    public function setLeType(?AisShipType $leType): self
    {
        $this->leType = $leType;

        return $this;
    }

    public function getLePavillon(): ?Pays
    {
        return $this->lePavillon;
    }

    public function setLePavillon(?Pays $lePavillon): self
    {
        $this->lePavillon = $lePavillon;

        return $this;
    }

    public function getPortDestination(): ?Port
    {
        return $this->portDestination;
    }

    public function setPortDestination(?Port $portDestination): self
    {
        $this->portDestination = $portDestination;

        return $this;
    }

    /**
     * @return Collection|Escale[]
     */
    public function getLesEscales(): Collection
    {
        return $this->lesEscales;
    }

    public function addLesEscale(Escale $lesEscale): self
    {
        if (!$this->lesEscales->contains($lesEscale)) {
            $this->lesEscales[] = $lesEscale;
            $lesEscale->setLeNavire($this);
        }

        return $this;
    }

    public function removeLesEscale(Escale $lesEscale): self
    {
        if ($this->lesEscales->removeElement($lesEscale)) {
            // set the owning side to null (unless already changed)
            if ($lesEscale->getLeNavire() === $this) {
                $lesEscale->setLeNavire(null);
            }
        }

        return $this;
    }

    public function getLongueur(): ?int
    {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTriantdeau(): ?string
    {
        return $this->triantdeau;
    }

    public function setTriantdeau(string $triantdeau): self
    {
        $this->triantdeau = $triantdeau;

        return $this;
    }

    
}
