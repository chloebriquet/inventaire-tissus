<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColorRepository")
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fabric", mappedBy="color")
     */
    private $fabrics;

    public function __construct()
    {
        $this->fabrics = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Fabric[]
     */
    public function getFabrics(): Collection
    {
        return $this->fabrics;
    }

    public function addFabric(Fabric $fabric): self
    {
        if (!$this->fabrics->contains($fabric)) {
            $this->fabrics[] = $fabric;
            $fabric->addColor($this);
        }

        return $this;
    }

    public function removeFabric(Fabric $fabric): self
    {
        if ($this->fabrics->contains($fabric)) {
            $this->fabrics->removeElement($fabric);
            $fabric->removeColor($this);
        }

        return $this;
    }
}
