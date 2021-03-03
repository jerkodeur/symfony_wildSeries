<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
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
     */
    private $name;

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
}
