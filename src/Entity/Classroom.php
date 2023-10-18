<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Classroom = null;

    #[ORM\OneToMany(mappedBy: 'class', targetEntity: Student::class)]
    private Collection $class;

    public function __construct()
    {
        $this->class = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassroom(): ?string
    {
        return $this->Classroom;
    }

    public function setClassroom(?string $Classroom): static
    {
        $this->Classroom = $Classroom;

        return $this;
    }
    public function __toString(): string
    {
        return $this->Classroom; 
    }

    /**
     * @return Collection<int, Student>
     */
    public function getClass(): Collection
    {
        return $this->class;
    }

    public function addClass(Student $class): static
    {
        if (!$this->class->contains($class)) {
            $this->class->add($class);
            $class->setClass($this);
        }

        return $this;
    }

    public function removeClass(Student $class): static
    {
        if ($this->class->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getClass() === $this) {
                $class->setClass(null);
            }
        }

        return $this;
    }
}
