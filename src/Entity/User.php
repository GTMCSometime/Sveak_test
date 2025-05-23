<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\NotBlank
        (message: 'Значение {{ value }} некорректно, либо поле не заполнено.',
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Значение {{ value }} некорректно.',
    )]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Имя должно быть длиннее {{ limit }} символов',
        maxMessage: 'Имя должно быть короче {{ limit }} символов',
    )]
    #[ORM\Column(length: 50)]    
    private ?string $name = null;


    #[Assert\NotBlank
        (message: 'Значение {{ value }} некорректно, либо поле не заполнено.',
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Значение {{ value }} некорректно.',
    )]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Фамилия должна быть длиннее {{ limit }} символов',
        maxMessage: 'Фамилия должна быть короче {{ limit }} символов',
    )]
    #[ORM\Column(length: 50)]  
    private ?string $surname = null;


    #[Assert\NotBlank
        (message: 'Значение {{ value }} некорректно, либо поле не заполнено.',
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Значение {{ value }} некорректно.',
    )]

    #[Assert\Regex(
        pattern: '/^9\d{9}$/',
        message: "Телефон должен начинаться с '9' и содержать 10 цифр."
    )]
    #[ORM\Column(length: 10)]  
    private ?string $phone_number = null;


    #[Assert\NotBlank
        (message: 'Значение {{ value }} некорректно, либо поле не заполнено.',
    )]
    #[Assert\Email
        (message: 'Значение {{ value }} не является email-адресом',
    )]
    #[ORM\Column(length: 320)]
    private ?string $email = null;
    

    #[Assert\NotBlank
        (message: 'Значение {{ value }} некорректно, либо поле не заполнено.',
    )]
    #[ORM\Column(length: 50)]
    private ?string $education = null;

    #[Assert\Type(
        type: 'boolean',
        message: 'Значение {{ value }} некорректно.',
        )]
    #[ORM\Column(type: 'boolean')]
    private bool $agree_terms = false;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $score = null;
    

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

    public function getAgreeTerms(): ?bool
    {
        return $this->agree_terms;
    }

    public function setAgreeTerms(bool $agree_terms): static
    {
        $this->agree_terms = $agree_terms;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }


}
