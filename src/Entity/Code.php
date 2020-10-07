<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CodeRepository")
 *
 * @UniqueEntity("name", message="unique_entity")
 *
 * @ApiResource
 */
class Code
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="not_blank")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $used_at;

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

    public function getUsedAt(): ?\DateTimeInterface
    {
        return $this->used_at;
    }

    public function setUsedAt(?\DateTimeInterface $used_at): self
    {
        $this->used_at = $used_at;

        return $this;
    }
}
