<?php

namespace App\Entity;

use App\Repository\GlaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlaceRepository::class)]
class Glace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredientSpecial = null;

    #[ORM\ManyToOne(inversedBy: 'glaces')]
    private ?Cone $cone = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredientSpecial(): ?string
    {
        return $this->ingredientSpecial;
    }

    public function setIngredientSpecial(string $ingredientSpecial): static
    {
        $this->ingredientSpecial = $ingredientSpecial;

        return $this;
    }

    public function getCone(): ?Cone
    {
        return $this->cone;
    }

    public function setCone(?Cone $cone): static
    {
        $this->cone = $cone;

        return $this;
    }
}
