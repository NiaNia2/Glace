<?php

namespace App\Entity;

use App\Repository\ConeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ConeRepository::class)]
class Cone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Glace>
     */
    #[ORM\OneToMany(targetEntity: Glace::class, mappedBy: 'cone')]
    private Collection $glaces;

    public function __construct()
    {
        $this->glaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Glace>
     */
    public function getGlaces(): Collection
    {
        return $this->glaces;
    }

    public function addGlace(Glace $glace): static
    {
        if (!$this->glaces->contains($glace)) {
            $this->glaces->add($glace);
            $glace->setCone($this);
        }

        return $this;
    }

    public function removeGlace(Glace $glace): static
    {
        if ($this->glaces->removeElement($glace)) {
            // set the owning side to null (unless already changed)
            if ($glace->getCone() === $this) {
                $glace->setCone(null);
            }
        }

        return $this;
    }
}
