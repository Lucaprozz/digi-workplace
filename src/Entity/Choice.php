<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChoiceRepository")
 */
class Choice
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
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="Q_Id")
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="choice")
     */
    private $C_Id;

    public function __construct()
    {
        $this->C_Id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getCId(): Collection
    {
        return $this->C_Id;
    }

    public function addCId(Answer $cId): self
    {
        if (!$this->C_Id->contains($cId)) {
            $this->C_Id[] = $cId;
            $cId->setChoice($this);
        }

        return $this;
    }

    public function removeCId(Answer $cId): self
    {
        if ($this->C_Id->contains($cId)) {
            $this->C_Id->removeElement($cId);
            // set the owning side to null (unless already changed)
            if ($cId->getChoice() === $this) {
                $cId->setChoice(null);
            }
        }

        return $this;
    }
}
