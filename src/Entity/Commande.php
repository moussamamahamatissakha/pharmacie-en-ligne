<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Medicament::class)]
    private Collection $medicaments;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zone = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Livreur $livreur = null;

    public function __construct()
    {
        $this->medicaments = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Medicament>
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments->add($medicament);
            $medicament->setCommande($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getCommande() === $this) {
                $medicament->setCommande(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }

 

   
}
