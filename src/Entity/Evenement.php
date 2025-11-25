<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Evenement')]
    private ?Activite $activite = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Date = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column]
    private ?int $nombreParticipant = null;

    /**
     * @var Collection<int, Intervenant>
     */
    #[ORM\ManyToMany(targetEntity: Intervenant::class, inversedBy: 'evenements')]
    private Collection $Intervenant;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Organisateur $Organisateur = null;

    /**
     * @var Collection<int, Participant>
     */
    #[ORM\ManyToMany(targetEntity: Participant::class, inversedBy: 'evenements')]
    private Collection $Participant;

    public function __construct()
    {
        $this->Intervenant = new ArrayCollection();
        $this->Participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNombreParticipant(): ?int
    {
        return $this->nombreParticipant;
    }

    public function setNombreParticipant(int $nombreParticipant): static
    {
        $this->nombreParticipant = $nombreParticipant;

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenant(): Collection
    {
        return $this->Intervenant;
    }

    public function addIntervenant(Intervenant $intervenant): static
    {
        if (!$this->Intervenant->contains($intervenant)) {
            $this->Intervenant->add($intervenant);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): static
    {
        $this->Intervenant->removeElement($intervenant);

        return $this;
    }

    public function getOrganisateur(): ?Organisateur
    {
        return $this->Organisateur;
    }

    public function setOrganisateur(?Organisateur $Organisateur): static
    {
        $this->Organisateur = $Organisateur;

        return $this;
    }

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipant(): Collection
    {
        return $this->Participant;
    }

    public function addParticipant(Participant $participant): static
    {
        if (!$this->Participant->contains($participant)) {
            $this->Participant->add($participant);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): static
    {
        $this->Participant->removeElement($participant);

        return $this;
    }
}
