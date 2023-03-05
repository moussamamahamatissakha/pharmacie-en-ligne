<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MedicamentRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MedicamentRepository::class)]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn("disc")]
#[DiscriminatorMap([
   "sirop"=>"Sirop",
   "comprime"=>"Comprime",
   "poudre"=>"Poudre",
])]
class Medicament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTimeInterface $date_exp = null;

    #[ORM\Column(length: 255)]
    protected ?string $libelle = null;

    #[ORM\Column]
    protected ?float $prix = null;

    #[ORM\Column(length: 30)]
    protected ?string $etat = null;

  

    #[ORM\Column(length: 255)]
    protected ?string $image = null;

    #[ORM\Column(length: 255)]
    protected ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'medicaments')]
    private ?Commande $commande = null;

    public function __construct()
    {
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateExp(): ?\DateTimeInterface
    {
        return $this->date_exp;
    }

    public function setDateExp(\DateTimeInterface $date_exp): self
    {
        $this->date_exp = $date_exp;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
