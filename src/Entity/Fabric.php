<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FabricRepository")
 * @ORM\HasLifecycleCallbacks
 *
 * @ApiResource
 */
class Fabric
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public ?int $id = null;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="not_blank")
     */
    public int $box;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="not_blank")
     */
    public string $material;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="not_blank")
     */
    public string $pattern;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="not_blank")
     */
    public string $state;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="not_blank")
     */
    public string $thickness;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public ?int $width = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public ?int $length = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $comment = null;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Color", inversedBy="fabrics", cascade={"persist"})
     *
     * @Assert\Count(min="1")
     */
    public Collection $colors;

    /**
     * @ORM\Column(type="datetime")
     */
    public ?\DateTimeInterface $createdAt = null;

    /**
     * @ORM\Column(type="datetime")
     */
    public ?\DateTimeInterface $updatedAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->colors->contains($color)) {
            $this->colors->removeElement($color);
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $now = new \DateTimeImmutable();

        $this->updatedAt = $now;
        if (null === $this->createdAt) {
            $this->updatedAt = $now;
        }
    }
}
