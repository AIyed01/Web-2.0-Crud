<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NAME = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $EMAIL = null;

    #[ORM\Column(nullable: true)]
    private ?float $age = null;

    #[ORM\ManyToOne(inversedBy: 'class')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classroom $class = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNAME(): ?string
    {
        return $this->NAME;
    }

    public function setNAME(?string $NAME): static
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getEMAIL(): ?string
    {
        return $this->EMAIL;
    }

    public function setEMAIL(?string $EMAIL): static
    {
        $this->EMAIL = $EMAIL;

        return $this;
    }

    public function getAge(): ?float
    {
        return $this->age;
    }

    public function setAge(?float $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getClass(): ?Classroom
    {
        return $this->class;
    }

    public function setClass(?Classroom $class): static
    {
        $this->class = $class;

        return $this;
    }
}
