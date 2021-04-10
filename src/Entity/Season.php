<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 * @UniqueEntity(fields = {"number", "program"}, message ="Cette saison est déjà existante")
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="season")
     * @ORM\JoinColumn(nullable=false)
     */
    private $program;

    /**
     * @ORM\Column(type="integer")
     * @Assert\EnableAutoMapping()
     * @Assert\Positive
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex(pattern="/^[1|2]{1}\d{3}$/",match=true,message="* Format de date invalide")
     * @Assert\GreaterThan(value = 1900, message = "* Veuillez insérer une date supérieure à {{ compared_value }}")
     * @Assert\LessThanOrEqual(value= 2021, message = "* Date antérieure à la date actuelle")
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Episode::class, mappedBy="season", orphanRemoval=true)
     */
    private $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Episode[]
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes[] = $episode;
            $episode->setSeason($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSeason() === $this) {
                $episode->setSeason(null);
            }
        }

        return $this;
    }
}
