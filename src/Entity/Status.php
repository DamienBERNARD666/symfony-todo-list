<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=ToDo::class, mappedBy="status")
     */
    private $toDos;

    public function __construct()
    {
        $this->toDos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|ToDo[]
     */
    public function getToDos(): Collection
    {
        return $this->toDos;
    }

    public function addToDo(ToDo $toDo): self
    {
        if (!$this->toDos->contains($toDo)) {
            $this->toDos[] = $toDo;
            $toDo->setStatus($this);
        }

        return $this;
    }

    public function removeToDo(ToDo $toDo): self
    {
        if ($this->toDos->contains($toDo)) {
            $this->toDos->removeElement($toDo);
            // set the owning side to null (unless already changed)
            if ($toDo->getStatus() === $this) {
                $toDo->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->label;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
