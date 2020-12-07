<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NavireRepository::class)
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
     * @ORM\Column(type="string", length=7)
     * @Assert\Regex(pattern="/[1-9]{7}/",
     * message="Le numéro IMO doit comporter 7 chiffres")
     */
    private $numImo;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=3,max=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $numMMSI;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $indicatifAppel;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eta;

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
}
