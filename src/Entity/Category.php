<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="category")
     */
    private $c_id;

    public function __construct()
    {
        $this->c_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getCId(): Collection
    {
        return $this->c_id;
    }

    public function addCId(Question $cId): self
    {
        if (!$this->c_id->contains($cId)) {
            $this->c_id[] = $cId;
            $cId->setCategory($this);
        }

        return $this;
    }

    public function removeCId(Question $cId): self
    {
        if ($this->c_id->contains($cId)) {
            $this->c_id->removeElement($cId);
            // set the owning side to null (unless already changed)
            if ($cId->getCategory() === $this) {
                $cId->setCategory(null);
            }
        }

        return $this;
    }
}
