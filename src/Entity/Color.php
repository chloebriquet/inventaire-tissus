<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColorRepository")
 *
 * @UniqueEntity("name")
 * @UniqueEntity("code")
 *
 * @ApiResource
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    public string $code;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fabric", mappedBy="colors")
     */
    public Collection $fabrics;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->fabrics = new ArrayCollection();
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
