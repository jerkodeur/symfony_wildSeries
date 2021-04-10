<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * TODO defintion des propriétés et contraintes d'un champ d'une entité
     * ? Certaines propriétés sont spécifiques, comme l'id, qui est représentée par un integer auto-incrémenté.
     * @ORM\Id
     * ? Défini que la clé est primaire
     * @ORM\GeneratedValue
     * ? Indique que la valeur sera auto-incrémentée. (Augmentera de 1 à chaque nouvel enregistrement)
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\EnableAutoMapping()
     * @Assert\NotBlank(message = "* Le nom de la catégorie doit être renseigné")
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "* Erreur: Caractères maximum autorisés = {{ limit }}"
     * )
     */
    private $name;

    /**
     * One category have many programs
     * @var Collection
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="category")
     */
    private $programs;

    /**
     * @ORM\Column
     */
    private $slug;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the category programs
     *
     * @return \Doctrine\Common\Collections\ArrayCollection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    /**
     * Add a program to the category collection
     *
     * @param Program $program
     *
     * @return self
     */
    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setCategory($this);
        }

        return $this;
    }

    /**
     * Remove a program from the category collection
     *
     * @param Program $program
     *
     * @return self
     */
    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)) {
            $this->programs->removeElement($program);
            if ($program->getCategory() === $this) {
                $program->setCategory(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
