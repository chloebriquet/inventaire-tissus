<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Validator\Constraints\HasSameValue;
use App\Validator\Constraints\IsCodeAvailable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 * @HasSameValue(fields={"plainPassword", "passwordConfirmation"}, type="Le mot de passe", errorPath="passwordConfirmation", groups={"user:create"})
 * @HasSameValue(fields={"email", "emailConfirmation"}, type="L'email", errorPath="emailConfirmation", groups={"user:create"})
 *
 * @ApiResource
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    public ?UuidInterface $uuid = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\NotBlank
     */
    public string $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\Email
     * @Assert\NotBlank
     */
    public string $email;

    /**
     * @Assert\Email
     * @Assert\NotBlank(groups={"user:create"}, message="not_blank")
     */
    public string $emailConfirmation;

    /**
     * @ORM\Column(type="json")
     */
    protected array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    public ?string $password = null;

    /**
     * @Assert\NotBlank(groups={"user:create"})
     * @Assert\Regex("/^(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?[!-\/:-@[-`{-~])[a-zA-Z0-9!-\/:-@[-`{-~]{8,}$/", message="password.composition")
     */
    public ?string $plainPassword = null;

    /**
     * @Assert\NotBlank(groups={"user:create"})
     */
    public ?string $passwordConfirmation = null;

    /**
     * @Assert\NotBlank(groups={"user:create"})
     * @IsCodeAvailable
     */
    public ?string $code = null;

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
