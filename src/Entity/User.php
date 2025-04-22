<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    private ?string $name = null;
    private ?string $surname = null;
    private ?string $phoneNumber = null;
    private ?string $education = null;
    private ?int $approval = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname() : ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname) : static
    {
        $this->name = $surname;

        return $this;
    }

    public function getPhoneNumber() : ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber) : static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(string $education): static
    {
        $this->education = $education;

        return $this;
    }

    public function getApproval(): ?string
    {
        return $this->approval;
    }

    public function setApproval(int $approval): static
    {
        $this->approval = $approval;

        return $this;
    }

    

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */

    /**
     * @see PasswordAuthenticatedUserInterface
     */

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
