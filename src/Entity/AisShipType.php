<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AisShipTypeRepository::class)
 * @ORM\Table(name="aisshiptype")
 */
class AisShipType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",name="aisshiptype")
     * @Assert\Length(min=1,max=9,minMessage="Le type d'un navire doit être compris entre 1 et 9",
     * maxMessage="Le type d'un navire doit être compris entre 1 et 9",allowEmptyString=false)
     */
    private $aisShipType;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $libelle;

    /**
     * @ORM\Column(name="lesPortsId")
     * @ORM\ManyToOne(targetEntity=Port::class, inversedBy="lesTypes")
     * @ORM\JoinTable(
     *      name="porttypecompatible",
     *      joinColumns={@ORM\JoinColumn(name="idaistype",referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idport",referencedColumnName="id")}
     * )
     */
    private $lesPorts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAisShipType(): ?int
    {
        return $this->aisShipType;
    }

    public function setAisShipType(int $aisShipType): self
    {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getLesPorts(): ?Port
    {
        return $this->lesPorts;
    }

    public function setLesPorts(?Port $lesPorts): self
    {
        $this->lesPorts = $lesPorts;

        return $this;
    }
}
