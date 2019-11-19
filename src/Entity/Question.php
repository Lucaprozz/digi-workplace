<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="S_id")
     */
    private $survey;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="c_id")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choice", mappedBy="question")
     */
    private $Q_Id;

    public function __construct()
    {
        $this->Q_Id = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    /**
     * @return Collection|Choice[]
     */
    public function getQId(): Collection
    {
        return $this->Q_Id;
    }

    public function addQId(Choice $qId): self
    {
        if (!$this->Q_Id->contains($qId)) {
            $this->Q_Id[] = $qId;
            $qId->setQuestion($this);
        }

        return $this;
    }

    public function removeQId(Choice $qId): self
    {
        if ($this->Q_Id->contains($qId)) {
            $this->Q_Id->removeElement($qId);
            // set the owning side to null (unless already changed)
            if ($qId->getQuestion() === $this) {
                $qId->setQuestion(null);
            }
        }

        return $this;
    }
}
