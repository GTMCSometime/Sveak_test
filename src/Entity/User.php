<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 180)]
    private ?string $name = null;
    #[ORM\Column(length: 180)]
    private ?string $surname = null;
    #[ORM\Column(length: 180)]
    private ?string $phone_number = null;
    #[ORM\Column(length: 180)]
    private ?string $education = null;
    #[ORM\Column(length: 180)]
    private ?int $agree_terms = null;
    

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
        $this->surname = $surname;

        return $this;
    }

    public function getPhoneNumber() : ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number) : static
    {
        $this->phone_number = $phone_number;

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

    public function getAgreeTerms(): ?string
    {
        return $this->agree_terms;
    }

    public function setAgreeTerms(int $agree_terms): static
    {
        $this->agree_terms = $agree_terms;

        return $this;
    }

}
