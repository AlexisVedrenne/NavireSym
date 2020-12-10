<?php

namespace App\Entity;

use App\Repository\PayRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PayRepository::class)
 * @ORM\Table(name="pays",uniqueConstraints={@ORM\UniqueConstraint(name="indicatif_unique",columns={"indicatif"})},indexes={@ORM\Index(name="ind_indicatif",columns={"indicatif"})})
 */
class Pays
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
     * @ORM\Column(type="string", length=3)
     * @Assert\Regex(pattern="/[A-Z]{3}/",message="L'indicatif Pays a strictement 3 caractère")
     */
    private $indicatif;

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
}
