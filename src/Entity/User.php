<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Validator\Constraints\HasSameValue;
use App\Validator\Constraints\IsInDatabase;
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
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $uuid;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     * @Assert\Email
     * @Assert\NotBlank(groups={"user:create"})
     */
    private $emailConfirmation;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @Assert\NotBlank(groups={"user:create"})
     * @Assert\Regex("/^(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9!#\$%&'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]{8,}$/")
     */
    private $plainPassword;

    /**
     * @var string
     * @Assert\NotBlank(groups={"user:create"})
     */
    private $passwordConfirmation;

    /**
     * @var string
     * @Assert\NotBlank(groups={"user:create"})
     * @IsInDatabase(className="App:Code")
     */
    private $code;

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPasswordConfirmation(): ?string
    {
        return $this->passwordConfirmation;
    }

    public function setPasswordConfirmation(string $passwordConfirmation): self
    {
        $this->passwordConfirmation = $passwordConfirmation;

        return $this;
    }

    public function getEmailConfirmation(): ?string
    {
        return $this->emailConfirmation;
    }

    public function setEmailConfirmation(string $emailConfirmation): self
    {
        $this->emailConfirmation = $emailConfirmation;

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
}
